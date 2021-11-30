<?php

namespace App\Http\Controllers\Admin\MainPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\MainPage\CreateNoveltiesRequest;
use App\Http\Requests\AdminPanel\MainPage\SaleOutRequest;
use App\Http\Resources\AdminPanel\MainPage\NoveltiesResource;
use App\Http\Resources\AdminPanel\MainPage\SaleOutResource;
use App\Models\AdminPanel\MainPage\Hit;
use App\Models\AdminPanel\MainPage\Novelty;
use App\Models\AdminPanel\MainPage\SaleOut;
use App\Models\Product\Item\Game;
use App\Models\Product\Item\Software;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SaleOutController extends Controller
{
    public function all()
    {
        try
        {
            $saleOuts = SaleOut::query()->select('id', 'item_id')->get();
            $itemsInfo = Game::query()->whereIn('id', $saleOuts->pluck('item_id'))->get();
            if ($itemsInfo == null)
            {
                $itemsInfo = Software::query()->whereIn('id', $saleOuts->pluck('item_id'))->get();
            }

            return view('admin/main-page/games/sale-out/list')->with(['saleOuts' => $saleOuts, 'itemsInfo' => $itemsInfo]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке распродаж главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function create(SaleOutRequest $request)
    {
        try
        {
            $saleOut = new SaleOut;
            $saleOut->item_id = $request->itemId;
            $saleOut->save();

            return redirect()->back()->withSuccess('Вы успешно добавили игру в распродажу главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при добавлении игры в распродажу главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function delete(SaleOut $saleOut)
    {
        try
        {
            $saleOut->delete();

            return redirect()->back()->withSuccess('Вы успешно удалили игру из распродаж главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении игры из распродаж главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
