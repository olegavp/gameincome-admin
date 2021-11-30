<?php

namespace App\Http\Controllers\Admin\MainPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\MainPage\CreateCategoryRequest;
use App\Http\Resources\AdminPanel\MainPage\CategoriesResource;
use App\Models\AdminPanel\MainPage\Category;
use App\Models\MainPageCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategoriesController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/main-page/categories/index');
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
            $mainPageCategories = MainPageCategory::query()->select('id', 'category_id', 'background')->get();
            $categories = Category::query()->whereIn('id', $mainPageCategories->pluck('category_id'))->get();

            return view('admin/main-page/categories/list')->with(['categories' => $mainPageCategories, 'categoriesInfo' => $categories]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке категорий главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createPage()
    {
        try
        {
            $categories = Category::query()->get();

            return view('admin/main-page/categories/create')->with(['categories' => $categories]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке категорий главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function create(CreateCategoryRequest $request)
    {
        try
        {
            $request = $request->validated();
            $filenameWithExt = $request['background']->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request['background']->getClientOriginalExtension();
            $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
            $request['background']->storeAs('public/', $fileNameToStore);
            $request['background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;

            $category = new MainPageCategory;
            $category->create($request);

            return redirect()->back()->withSuccess('Вы успешно добавили категорию на главную страницу!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при создании категории главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function delete(MainPageCategory $category)
    {
        try
        {
            $category->delete();

            return redirect()->back()->withSuccess('Вы успешно удалили категорию с главной страницы!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении категории с главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
