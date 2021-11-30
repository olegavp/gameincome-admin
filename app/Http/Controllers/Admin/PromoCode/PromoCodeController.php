<?php

namespace App\Http\Controllers\Admin\PromoCode;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\PromoCode\EditPromoCodeRequest;
use App\Http\Requests\AdminPanel\PromoCode\PromoCodeRequest;
use App\Http\Resources\AdminPanel\PromoCode\PromoCodeResource;
use App\Models\AdminPanel\PromoCode\PromoCode;
use App\Services\AdminPanel\PromoCode\PromoCodeService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PromoCodeController extends Controller
{
    private PromoCodeService $promoCode;

    public function __construct(PromoCodeService $promoCode)
    {
        $this->promoCode = $promoCode;
    }


    public function promoCodesPage()
    {
        try
        {
            return view('admin/promo-codes/index');
        }
        catch (\Throwable $e)
        {

        }
    }



    public function allPromoCodesPage()
    {
        try
        {
            $promoCodes = PromoCode::query()->orderBy('count', 'ASC')->orderBy('finish_time', 'ASC')->get();
            return view('admin/promo-codes/all-promo-codes-page')->with(['promoCodes' => $promoCodes]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function editPromoCodesPage(PromoCode $promoCode)
    {
        try
        {
            return view('admin/promo-codes/edit-promo-codes-page')->with(['promoCode' => $promoCode]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function editPromoCode(PromoCode $promoCode, EditPromoCodeRequest $request)
    {
        try
        {

            $this->promoCode->edit($promoCode, $request->validated());
            return redirect()->back()->withSuccess('Вы успешно обновили данный промокод');

        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function createPromoCodePage()
    {
        try
        {
            return view('admin/promo-codes/create-promo-code-page');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }

    }


    public function createPromoCode(PromoCodeRequest $request)
    {
        try
        {
            $this->promoCode->create($request);
            return redirect()->back()->withSuccess('Вы успешно добавили этот промокод');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }

    }



    public function deletePromoCode(PromoCode $promoCode)
    {
        try
        {
            $this->promoCode->delete($promoCode);
            return redirect()->back()->withSuccess('Вы успешно удалили этот промокод. Если вы хотите его восстановить, то воспользуйтесь корзиной.');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }
}
