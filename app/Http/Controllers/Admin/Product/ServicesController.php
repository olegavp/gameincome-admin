<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\Product\CreateServiceRequest;
use App\Http\Requests\AdminPanel\Product\EditServiceRequest;
use App\Http\Resources\AdminPanel\Product\ServicesResource;
use App\Models\AdminPanel\Product\Service;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Str;

class ServicesController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/services/index');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке категорий главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function all()
    {
        try
        {
            $services = ServicesResource::collection(Service::query()->get());
            return view('admin/services/list')->with(['services' => $services]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке сервисов, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createPage()
    {
        try
        {
            return view('admin/services/create');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании сервиса, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function create(CreateServiceRequest $request)
    {
        try
        {
            $request = $request->validated();
            $service = new Service;
            $service->name = $request['name'];
            $service->slug = Str::slug($request['name']);

            if (isset($request['background']))
            {
                $envPath = env('URL_FOR_FILES');
                $filenameWithExt = $request['background']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request['background']->getClientOriginalExtension();
                $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                $request['background']->storeAs('public/', $fileNameToStore);
                $request['background'] = $envPath . '/storage/' . $fileNameToStore;
            }

            $service->background = $request['background'];
            $service->save();

            return redirect()->back()->withSuccess('Вы успешно добавили сервис на ваш сайт!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при добавлении сервиса, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function editPage(Service $service)
    {
        try
        {
            return view('admin/services/edit-service')->with(['service' => $service]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании сервиса, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }



    public function edit(Service $service, EditServiceRequest $request): JsonResponse
    {
        try
        {
            $request = $request->validated();

            if (isset($request['background']))
            {
                $envPath = env('URL_FOR_FILES');
                $filenameWithExt = $request['background']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $request['background']->getClientOriginalExtension();
                $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                $request['background']->storeAs('public/', $fileNameToStore);
                $request['background'] = $envPath . '/storage/' . $fileNameToStore;
            }

            $request['slug'] = Str::slug($request['name']);

            $service->update($request);

            return redirect()->back()->withSuccess('Вы успешно отредактировали сервис!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании сервиса, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function delete(Service $service)
    {
        try
        {
            $service->delete();
            return redirect()->back()->withSuccess('Вы успешно удалили сервис!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении сервиса, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
