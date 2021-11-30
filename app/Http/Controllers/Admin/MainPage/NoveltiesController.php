<?php

namespace App\Http\Controllers\Admin\MainPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\MainPage\CreateNoveltiesRequest;
use App\Http\Resources\AdminPanel\MainPage\NoveltiesResource;
use App\Models\AdminPanel\MainPage\Hit;
use App\Models\AdminPanel\MainPage\Novelty;
use App\Models\Product\Item\Game;
use App\Models\Product\Item\Software;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NoveltiesController extends Controller
{
    public function all()
    {
        try
        {
            $novelties = Novelty::query()->select('id', 'item_id')->get();
            $itemsInfo = Game::query()->whereIn('id', $novelties->pluck('item_id'))->get();
            if ($itemsInfo == null)
            {
                $itemsInfo = Software::query()->whereIn('id', $novelties->pluck('item_id'))->get();
            }

            return view('admin/main-page/games/novelties/list')->with(['novelties' => $novelties, 'itemsInfo' => $itemsInfo]);        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке новинок главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function create(CreateNoveltiesRequest $request)
    {
        try
        {
            $novelty = new Novelty;
            $novelty->item_id = $request->itemId;
            $novelty->save();

            return redirect()->back()->withSuccess('Вы успешно добавили игру в новинки главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при добавлении игры в новинки главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function delete(Novelty $novelty)
    {
        try
        {
            $novelty->delete();

            return redirect()->back()->withSuccess('Вы успешно удалили игру из новинок главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении игры из новинок главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
