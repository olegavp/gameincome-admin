<?php

namespace App\Http\Controllers\Admin\MainPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\MainPage\CreateInsertRequest;
use App\Http\Resources\AdminPanel\MainPage\InsertsResource;
use App\Models\AdminPanel\MainPage\Insert;

class InsertsController extends Controller
{
    public function insertsPage()
    {
        try
        {
            $canCreate = (Insert::query()->count() == 3)  ? 'No' : 'Yes';
            return view('admin/main-page/inserts/index')->with(['canCreate' => $canCreate]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке вставок главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function getInserts()
    {
        try
        {
            $inserts = InsertsResource::collection(Insert::query()->get());
            return view('admin/main-page/inserts/all-inserts-page')->with(['inserts' => $inserts]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке вставок главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createInsertPage()
    {
        try
        {
            return view('admin/main-page/inserts/create-insert-page');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при создании вставки главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createInsert(CreateInsertRequest $request)
    {
        try
        {
            if (Insert::query()->count() == 3)
                return response()->json(['warning' => 'Вы не можете создать вставку, так как их уже 3 на сайте!']);

            $request = $request->validated();

            $filenameWithExt = $request['background']->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request['background']->getClientOriginalExtension();
            $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
            $request['background']->storeAs('public/', $fileNameToStore);
            $request['background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;

            $insert = new Insert;
            $insert->create($request);

            return redirect()->back()->withSuccess('Вы успешно добавили вставку на главную страницу!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при создании вставки главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function delete(Insert $insert)
    {
        try
        {
            $insert->delete();

            return redirect()->back()->withSuccess('Вы успешно удалили вставку на главной странице!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении вставки главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
