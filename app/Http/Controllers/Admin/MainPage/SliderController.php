<?php

namespace App\Http\Controllers\Admin\MainPage;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\MainPage\CreateSliderRequest;
use App\Http\Requests\AdminPanel\MainPage\EditSliderRequest;
use App\Http\Resources\AdminPanel\MainPage\BigSliderResource;
use App\Models\AdminPanel\MainPage\Slider;
use App\Services\AdminPanel\MainPage\SliderService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SliderController extends Controller
{
    private SliderService $sliderService;

    public function __construct(SliderService $sliderService)
    {
        $this->sliderService = $sliderService;
    }


    public function getSliderFramesPage()
    {
        try
        {
            return view('admin/main-page/slider/index');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке слайдов главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function getSliderFrames()
    {
        try
        {
            $frames = BigSliderResource::collection(Slider::query()->get());
            return view('admin/main-page/slider/all-slider-frames-page')->with(['frames' => $frames]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке слайдов главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createSliderFramePage()
    {
        try
        {
            return view('admin/main-page/slider/create-slider-frame-page');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при создании слайда главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createSliderFrame(CreateSliderRequest $request)
    {
        try
        {
            return $this->sliderService->create($request->validated());
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при создании слайда главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function editSliderFramePage(Slider $slider)
    {
        try
        {
            return view('admin/main-page/slider/edit-slider-frame-page')->with(['frame' => $slider]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании слайда главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function editSliderFrame(Slider $slider, EditSliderRequest $request)
    {
        try
        {
            return $this->sliderService->edit($slider, $request->validated());
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании слайда главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function deleteSliderFrame(Slider $slider)
    {
        try
        {
            $slider->delete();

            return redirect()->back()->withSuccess('Вы успешно удалили данный слайд!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении слайда главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
