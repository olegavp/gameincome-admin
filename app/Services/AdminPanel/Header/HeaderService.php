<?php

namespace App\Services\AdminPanel\Header;

use App\Http\Resources\AdminPanel\Header\HeaderResource;
use App\Models\AdminPanel\Header\Header;
use Illuminate\Http\JsonResponse;

class HeaderService
{
    public function create($data): JsonResponse|HeaderResource
    {
        try
        {
            $link = new Header;
            $link->name = $data->name;
            $link->slug = $data->slug;
            $link->save();

            return (new HeaderResource($link))
                ->additional(['message' => 'Вы успешно добавили ссылку в шапку.']);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function edit($header, $data): JsonResponse|HeaderResource
    {
        try {
            $header->update($data);

            return (new HeaderResource($header))
                ->additional(['message' => 'Вы успешно обновили эту ссылку!']);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function delete($header): JsonResponse|HeaderResource
    {
        try {
            $deletedModel = $header;
            $header->delete();
            return (new HeaderResource($deletedModel))->additional(['message' => 'Вы успешно удалили эту ссылку!']);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }
}
