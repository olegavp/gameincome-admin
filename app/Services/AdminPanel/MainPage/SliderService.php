<?php

namespace App\Services\AdminPanel\MainPage;

use App\Http\Resources\AdminPanel\MainPage\BigSliderResource;
use App\Models\AdminPanel\MainPage\Slider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class SliderService
{
    public function create($data)
    {
        try {
            if (!isset($data['text_on_button']))
            {
                $text_on_button = null;
            }
            else
            {
                $text_on_button = $data['text_on_button'];
            }
            if (!isset($data['link']))
            {
                $link = null;
            }
            else
            {
                $link = $data['link'];
            }
            
            

            if (isset($data['background']) and $data['background'] != null)
            {
                $filenameWithExt = $data['background']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $data['background']->getClientOriginalExtension();
                $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                $data['background']->storeAs('public/', $fileNameToStore);
                $data['background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
            }

            if (isset($data['preview_background']) and $data['preview_background'] != null)
            {
                $filenameWithExt = $data['preview_background']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $data['preview_background']->getClientOriginalExtension();
                $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                $data['preview_background']->storeAs('public/', $fileNameToStore);
                $data['preview_background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
            }
            
            
            $slider = new Slider;
            $slider->create([
                'name' => $data['name'],
                'small_description' => $data['small_description'],
                'description' => $data['description'],
                'text_on_button' => $text_on_button,
                'link' => $link,
                'background' => $data['background'],
                'preview_background' => $data['preview_background']
            ]);

            return redirect()->back()->withSuccess('Вы успешно добавили данный слайд слайдеру!');

        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при создании слайда главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function edit($slider, $data)
    {
        try {
            if (!isset($data['text_on_button']))
            {
                $text_on_button = null;
            }
            else
            {
                $text_on_button = $data['text_on_button'];
            }
            if (!isset($data['link']))
            {
                $link = null;
            }
            else
            {
                $link = $data['link'];
            }


            if (isset($data['background']) and $data['background'] != null)
            {
                $filenameWithExt = $data['background']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $data['background']->getClientOriginalExtension();
                $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                $data['background']->storeAs('public/', $fileNameToStore);
                $data['background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
            }
            else
            {
                $data['background'] = $slider->background;
            }

            if (isset($data['preview_background']) and $data['preview_background'] != null)
            {
                $filenameWithExt = $data['preview_background']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $data['preview_background']->getClientOriginalExtension();
                $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                $data['preview_background']->storeAs('public/', $fileNameToStore);
                $data['preview_background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
            }
            else
            {
                $data['preview_background'] = $slider->preview_background;
            }

            $slider->update([
                'name' => $data['name'],
                'small_description' => $data['small_description'],
                'description' => $data['description'],
                'text_on_button' => $text_on_button,
                'link' => $link,
                'background' => $data['background'],
                'preview_background' => $data['preview_background']
                ]);

            return redirect()->back()->withSuccess('Вы успешно обновили данный слайд слайдера!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании слайда главной страницы, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
