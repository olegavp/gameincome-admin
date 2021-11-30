<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Product\EditPlatformsRequest;
use App\Http\Requests\AdminPanel\Product\PlatformsRequest;
use App\Http\Resources\AdminPanel\Product\PlatformsResource;
use App\Models\AdminPanel\Product\Platform;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class PlatformsController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/platforms/index');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке платформ, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function all()
    {
        try
        {
            $platforms = PlatformsResource::collection(Platform::query()->get());
            return view('admin/platforms/list')->with(['platforms' => $platforms]);

        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке платформ, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createPage()
    {
        try
        {
            return view('admin/platforms/create');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при добавлении платформы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function create(PlatformsRequest $request)
    {
        try
        {
            $platform = new Platform;
            $platform->name = $request->name;
            $platform->slug = Str::slug($request->name);
            $platform->save();
            return redirect()->back()->withSuccess('Вы успешно добавили платформу на ваш сайт!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при добавлении платформы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function editPage(Platform $platform)
    {
        try
        {
            return view('admin/platforms/edit-platform')->with(['platform' => $platform]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании платформы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function edit(Platform $platform, EditPlatformsRequest $request)
    {
        try
        {
            $request = $request->validated();

            $request['slug'] = Str::slug($request['name']);

            $platform->update($request);

            return redirect()->back()->withSuccess('Вы успешно отредактировали платформу!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании платформы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function delete(Platform $platform)
    {
        try
        {
            $platform->delete();
            return redirect()->back()->withSuccess('Вы успешно удалили платформу!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении платформы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
