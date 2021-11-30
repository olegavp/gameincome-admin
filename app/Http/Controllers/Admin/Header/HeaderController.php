<?php

namespace App\Http\Controllers\AdminPanel\Header;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Header\EditHeaderRequest;
use App\Http\Requests\AdminPanel\Header\HeaderRequest;
use App\Http\Resources\AdminPanel\Header\HeaderResource;
use App\Models\AdminPanel\Header\Header;
use App\Services\AdminPanel\Header\HeaderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class HeaderController extends Controller
{
    private HeaderService $header;

    public function __construct(HeaderService $header){
        $this->header = $header;
    }


    public function allLinks(): JsonResponse|AnonymousResourceCollection
    {
        try
        {
            return HeaderResource::collection(Header::all());
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function createLink(HeaderRequest $request): JsonResponse|HeaderResource
    {
        try
        {
            return $this->header->create($request);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function editLink(Header $header, EditHeaderRequest $request): JsonResponse|HeaderResource
    {
        try
        {
            return $this->header->edit($header, $request->validated());
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function deleteLink(Header $header): JsonResponse|HeaderResource
    {
        try
        {
            return $this->header->delete($header);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }
}
