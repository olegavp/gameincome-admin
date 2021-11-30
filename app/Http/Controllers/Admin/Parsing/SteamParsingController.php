<?php

namespace App\Http\Controllers\AdminPanel\Parsing;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Product\Category;
use App\Models\AdminPanel\Product\ItemToCategory;
use App\Models\AdminPanel\Product\ItemToGenre;
use App\Models\AdminPanel\Product\ItemToPlatform;
use App\Models\AdminPanel\Product\ItemToService;
use App\Models\AdminPanel\Product\Genre;
use App\Models\AdminPanel\Product\Platform;
use App\Models\Product\Item\Game;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class SteamParsingController extends Controller
{
    public function getGames()
    {
        try
        {
            $uri = 'https://steamspy.com/api.php?request=top100in2weeks';

            $response = json_decode(Http::get($uri));

            foreach($response as $item)
            {
                $game = new Game;
                $game->steam_app_id = $item->appid;
                $game->name = $item->name;
                $game->developer = $item->developer;
                $game->publisher = $item->publisher;
                $game->save();
            }


            return response()->json(['message' => 'Парсинг закончился без каких-либо ошибок!', 'status' => 201], 201);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при парсинге игр, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function getUniqueGames()
    {
        $uniqueGames = Game::query()->get()->unique('steam_app_id');

        foreach ($uniqueGames as $uniqueGame)
        {
            $game = new UniqueGame;
            $game->steam_app_id = $uniqueGame['steam_app_id'];
            $game->name = $uniqueGame['name'];
            $game->developer = $uniqueGame['developer'];
            $game->publisher = $uniqueGame['publisher'];
            $game->save();
        }
        echo 'done';
    }


    public function getGamesInfo()
    {
        $games = Game::query()->limit(100)->orderBy('steam_app_id', 'ASC')->get();

        foreach ($games as $game)
        {
            DB::transaction(function () use ($game)
            {
                $appId = $game->steam_app_id;

                $uri = 'https://store.steampowered.com/api/appdetails/?l=russian&appids=' . $appId;
                $response = collect(Http::get($uri)->json()[$appId]['data']);

                $gameUuid = Game::query()->where('steam_app_id', $appId)->first()->id;

                if (ItemToService::query()->where(['service_id' => '94844e76-7198-4d54-b139-4babb4558dbb', 'item_id' => $gameUuid])->get()->isEmpty())
                {
                    $gameToService = new ItemToService;
                    $gameToService->item_id = $gameUuid;
                    $gameToService->service_id = '94844e76-7198-4d54-b139-4babb4558dbb';
                    $gameToService->save();
                }


                $supportedPlatforms = collect();

                collect($response['platforms'])->map(function ($item, $key) use ($supportedPlatforms)
                {
                    if ($item == 'true')
                    {
                        $supportedPlatforms->push($key);
                    }
                });

                $supportedPlatforms->map(function ($item, $key) use ($gameUuid)
                {
                    if (Platform::query()->where('slug', Str::slug($item))->get()->isEmpty())
                    {
                        $platform = new Platform;
                        $platform->name = $item;
                        $platform->slug = Str::slug($item);
                        $platform->save();
                    }
                    else
                    {
                        $platform = Platform::query()->where('slug', Str::slug($item))->first();
                    }

                    if (ItemToPlatform::query()->where(['platform_id' => $platform->id, 'item_id' => $gameUuid])->get()->isEmpty())
                    {
                        $gameToPlatform = new ItemToPlatform;
                        $gameToPlatform->item_id = $gameUuid;
                        $gameToPlatform->platform_id = $platform->id;
                        $gameToPlatform->save();
                    }
                });


                collect($response['genres'])->map(function ($item, $key) use ($gameUuid)
                {
                    if (Category::query()->where('slug', Str::slug($item['description']))->get()->isEmpty())
                    {
                        $category = new Category;
                        $category->name = $item['description'];
                        $category->slug = Str::slug($item['description']);
                        $category->save();
                    }
                    else
                    {
                        $category = Category::query()->where('slug', Str::slug($item['description']))->first();
                    }

                    if (ItemToCategory::query()->where(['category_id' => $category->id, 'item_id' => $gameUuid])->get()->isEmpty())
                    {
                        $gameToCategory = new ItemToCategory;
                        $gameToCategory->item_id = $gameUuid;
                        $gameToCategory->category_id = $category->id;
                        $gameToCategory->save();
                    }
                });


                collect($response['categories'])->map(function ($item, $key) use ($gameUuid)
                {
                    if (Genre::query()->where('slug', Str::slug($item['description']))->get()->isEmpty())
                    {
                        $genre = new Genre;
                        $genre->name = $item['description'];
                        $genre->slug = Str::slug($item['description']);
                        $genre->save();
                    }
                    else
                    {
                        $genre = Genre::query()->where('slug', Str::slug($item['description']))->first();
                    }


                    if (ItemToGenre::query()->where(['genre_id' => $genre->id, 'item_id' => $gameUuid])->get()->isEmpty())
                    {
                        $gameToGenre = new ItemToGenre;
                        $gameToGenre->item_id = $gameUuid;
                        $gameToGenre->genre_id = $genre->id;
                        $gameToGenre->save();
                    }

                });
            });
        }
        return 'done';
    }
}
