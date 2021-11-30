<?php

namespace App\Http\Controllers\Admin\MainPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\MainPage\CreateHitRequest;
use App\Http\Resources\AdminPanel\MainPage\HitResource;
use App\Models\AdminPanel\MainPage\Hit;
use App\Models\AdminPanel\MainPage\Recommendation;
use App\Models\Product\Item\Game;
use App\Models\Product\Item\Software;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HitsController extends Controller
{
    public function all()
    {
        try
        {
            $hits = Hit::query()->select('id', 'item_id')->get();
            $itemsInfo = Game::query()->whereIn('id', $hits->pluck('item_id'))->get();
            if ($itemsInfo == null)
            {
                $itemsInfo = Software::query()->whereIn('id', $hits->pluck('item_id'))->get();
            }

            return view('admin/main-page/games/hits/list')->with(['hits' => $hits, 'itemsInfo' => $itemsInfo]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке хитов главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function create(CreateHitRequest $request)
    {
        try
        {
            $hit = new Hit;
            $hit->item_id = $request->itemId;
            $hit->save();

            return redirect()->back()->withSuccess('Вы успешно добавили игру в хиты главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при добавлении игры в хиты главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function delete(Hit $hit)
    {
        try
        {
            $hit->delete();

            return redirect()->back()->withSuccess('Вы успешно удалили игру из хитов главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении игры из хитов главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
