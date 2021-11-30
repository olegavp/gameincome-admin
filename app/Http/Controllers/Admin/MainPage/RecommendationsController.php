<?php

namespace App\Http\Controllers\Admin\MainPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\MainPage\CreateRecommendationRequest;
use App\Models\AdminPanel\MainPage\Recommendation;
use App\Models\Product\Item\Game;
use App\Models\Product\Item\Software;
use Illuminate\Http\JsonResponse;

class RecommendationsController extends Controller
{
    public function all()
    {
        try
        {
            $recommendations = Recommendation::query()->select('id', 'item_id')->get();
            $itemsInfo = Game::query()->whereIn('id', $recommendations->pluck('item_id'))->get();
            if ($itemsInfo == null)
            {
                $itemsInfo = Software::query()->whereIn('id', $recommendations->pluck('item_id'))->get();
            }

            return view('admin/main-page/games/recommendations/list')->with(['recommendations' => $recommendations, 'itemsInfo' => $itemsInfo]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке рекоммендаций главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function create(CreateRecommendationRequest $request)
    {
        try
        {
            $recommendation = new Recommendation;
            $recommendation->item_id = $request->itemId;
            $recommendation->save();

            return redirect()->back()->withSuccess('Вы успешно добавили игру в рекоммендации главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при добавлении игры в рекоммендации главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function delete(Recommendation $recommendation)
    {
        try
        {
            $recommendation->delete();

            return redirect()->back()->withSuccess('Вы успешно удалили игру из рекоммендаций главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении игры из рекоммендаций главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
