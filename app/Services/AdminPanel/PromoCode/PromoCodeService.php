<?php

namespace App\Services\AdminPanel\PromoCode;

use App\Http\Resources\AdminPanel\PromoCode\PromoCodeResource;
use App\Models\AdminPanel\PromoCode\PromoCode;
use Illuminate\Http\JsonResponse;

class PromoCodeService
{
    public function create($data)
    {
        try
        {
            $promoCode = new PromoCode;
            $promoCode->name = $data->name;
            $promoCode->count = $data->count;
            $promoCode->money = $data->money * 100;
            $promoCode->finish_time = $data->finishTime;
            $promoCode->save();
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function edit($promoCode, $data)
    {
        try
        {
            $data['money'] = $data['money'] * 100;
            $promoCode->update($data);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function delete($promoCode)
    {
        try
        {
            $promoCode->delete();
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }
}
