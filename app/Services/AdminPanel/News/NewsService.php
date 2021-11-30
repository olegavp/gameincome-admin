<?php

namespace App\Services\AdminPanel\News;

use App\Http\Resources\AdminPanel\News\AllNewsResource;
use App\Http\Resources\AdminPanel\News\NewsCommentResource;
use App\Models\AdminPanel\News\News;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsService
{
    public function createNews($data)
    {
        try
        {
            // if (isset($data['description_on_3_words']) and $data['description_on_3_words'] !== null)
            // {
                if (isset($data['new_relation']) and $data['new_relation'] !== null)
                {
                    $data['relation'] = $data['new_relation'];
                }
                
                
                if (isset($data['small_background']) and $data['small_background'] !== null)
                {
                    $filenameWithExt = $data['small_background']->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $data['small_background']->getClientOriginalExtension();
                    $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                    $data['small_background']->storeAs('public/', $fileNameToStore);
                    $data['small_background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
                }
    
                if (isset($data['background']) and $data['background'] !== null)
                {
                    $filenameWithExt = $data['background']->getClientOriginalName();
                    $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                    $extension = $data['background']->getClientOriginalExtension();
                    $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                    $data['background']->storeAs('public/', $fileNameToStore);
                    $data['background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
                }
                
                
                return  response()->json(['data' => $data]);
            
                $news = News::create($data);
                            return redirect()->back()->withSuccess('Вы успешно создали новость!');

                
                // $news->name = $data['name'];
                // $news->description_on_3_words = $data['descriptionOn3Words'];
                // $news->small_description = $data['smallDescription'];
                // $news->description = $data['description'];
                // $news->type = 'small';
                // $news->relation = $data['relation'];

                // if (isset($data['small_background']) and $data['small_background'] !== null)
                // {
                //     $filenameWithExt = $data['small_background']->getClientOriginalName();
                //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //     $extension = $data['small_background']->getClientOriginalExtension();
                //     $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                //     $data['small_background']->storeAs('public/', $fileNameToStore);
                //     $data['small_background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
                    
                //     $news->small_background = $data['small_background'];
                // }
    
                // if (isset($data['background']) and $data['background'] !== null)
                // {
                //     $filenameWithExt = $data['background']->getClientOriginalName();
                //     $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                //     $extension = $data['background']->getClientOriginalExtension();
                //     $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                //     $data['background']->storeAs('public/', $fileNameToStore);
                //     $data['background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
                    
                //     $news->background = $data['background'];
                // }
            // }
            // else
            // {
            //     if (isset($data['new_relation']) and $data['new_relation'] !== null)
            //     {
            //         $data['relation'] = $data['new_relation'];
            //     }
            //     // $news = new News;
            //     // $news->name = $data['name'];
            //     // $news->small_description = $data['smallDescription'];
            //     // $news->description = $data['description'];
            //     // $news->type = 'big';
            //     // $news->relation = $data['relation'];

                
            //     if (isset($data['small_background']) and $data['small_background'] !== null)
            //     {
            //         $filenameWithExt = $data['small_background']->getClientOriginalName();
            //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //         $extension = $data['small_background']->getClientOriginalExtension();
            //         $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
            //         $data['small_background']->storeAs('public/', $fileNameToStore);
            //         $data['small_background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
                    
            //         // $news->small_background = $data['small_background'];
            //     }
    
            //     if (isset($data['background']) and $data['background'] !== null)
            //     {
            //         $filenameWithExt = $data['background']->getClientOriginalName();
            //         $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            //         $extension = $data['background']->getClientOriginalExtension();
            //         $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
            //         $data['background']->storeAs('public/', $fileNameToStore);
            //         $data['background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
                    
            //         // $news->background = $data['background'];
            //     }
                
            //     News::create($data);

            //     // $news->save();
            //}
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при создании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }

    //В АДМИНКЕ ВЫВОДИТЬ ВСЕ ЗАПИСИ, ГДЕ ЕСТЬ НУЛЛ В СВЯЗЯХ, ДАБЫ НАЙТИ БАГИ НА ПРОДАКШЕНЕ.
    //НАЗВАТЬ КАК ОШИБКИ НА ПРОДЕ ТИП "NULL"
    //ВЫВОДИТЬ В ПРОФИЛЬ ЮЗЕРА В АДМИНКЕ ИНФУ О ТОМ КОГДА ЮЗЕР БЫЛ ЗАБАНЕН И РАЗБАНЕН.
    //СДЕЛАТЬ УЛУЧШЕННЫЕ СВЯЗИ В НВОСТЯХ, ПО ТИПУ ХЭШТЭГОВ И НЕСКОЛЬКИХ ИГР. ВЫБОР НА САТЙЕ СХОЖИХ БУДЕТ ПО ТИПУ:
    //ПОКАЗАТЬ ПО ЭТОЙ ИГРЕ И ПОИСК ПО ХЭШТЭГАМ
    //ПРИВЯЗАТЬ КАЖДОМУ РЕДАКТОРУ НОВОСТЕЙ СВОЮ НОВСТЬ ДЛЯ РЕДАКТИРОВАНИЯ
    //Показывать в корзине новость с комментариями, при удалении в корзине новости удаляются и комментарии
    //также в коризне по истечении 60 дней происходит удаление нвостей, в месте и с ними комментраии
    //В промокодах, типах новостей и тд в рекветах сделать правило чтобы был конкретный ывыбор занчений
    //Сделать формреквест с выбором причины бана
    //Создать таблицу в которую при ошибке будет сохраняться ip пользователя + ошибка. Переписать текстовые ошибки где
    //проишошла ошибка на Произошла ошибка во время... не удалось завершить...


    public function editNews($news, $data)
    {
        try
        {
            if (isset($data['new_relation']) and $data['new_relation'] !== null)
            {
                $data['relation'] = $data['new_relation'];
            }

            if (isset($data['small_background']) and $data['small_background'] !== null)
            {
                $filenameWithExt = $data['small_background']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $data['small_background']->getClientOriginalExtension();
                $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                $data['small_background']->storeAs('public/', $fileNameToStore);
                $data['small_background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
            }

            if (isset($data['background']) and $data['background'] !== null)
            {
                $filenameWithExt = $data['background']->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
                $extension = $data['background']->getClientOriginalExtension();
                $fileNameToStore = "backgrounds/" . $filename . "_" . time() . "." . $extension;
                $data['background']->storeAs('public/', $fileNameToStore);
                $data['background'] = env('URL_FOR_FILES') . '/storage/' . $fileNameToStore;
            }

            $news->update($data);

            return redirect()->back()->withSuccess('Вы успешно обновили эту новость!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function deleteNews($news): AllNewsResource|JsonResponse
    {
        try
        {
            $deletedModel = $news;
            $news->delete();

            return (new AllNewsResource($deletedModel))
                ->additional(['message' => 'Вы успешно удалили эту новость! Если вы хотите её восстановить, то воспользуйтесь корзиной.',
                    'status' => 200]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function deleteComment($newsComment): NewsCommentResource|JsonResponse
    {
        try
        {
            $deletedModel = $newsComment;
            $newsComment->delete();

            return (new NewsCommentResource($deletedModel))
                ->additional(['message' => 'Вы успешно удалили этот комментарий! Если вы хотите восстановить его, то воспользуйстесь корзиной.',
                    'status' => 200]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении комментария новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
