<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPanel\News\CreateNewsRequest;
use App\Http\Requests\AdminPanel\News\EditNewsRequest;
use App\Models\AdminPanel\News\News;
use App\Models\AdminPanel\News\NewsComment;
use App\Services\AdminPanel\News\NewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;

class NewsController extends Controller
{
    private NewsService $newsService;

    public function __construct(NewsService $newsService){
        $this->newsService = $newsService;
    }


    public function newsPage(): View|Factory|JsonResponse|Application
    {
        try
        {
            $smallNewsCount = News::query()->where('type', 'small')->count();
            $bigNewsCount = News::query()->where('type', 'big')->count();
            return view('admin/news/index')->with(['countOfSmallNews' => $smallNewsCount, 'countOfBigNews' => $bigNewsCount]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке страницы новостей, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function smallNews(): View|Factory|JsonResponse|Application
    {
        try
        {
            $news = News::query()->where('type', 'small')->orderBy('created_at', 'DESC')->paginate(8);
            return view('admin/news/small-news')->with(['news' => $news]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке всех новостей, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function bigNews(): View|Factory|JsonResponse|Application
    {
        try
        {
            $news = News::query()->where('type', 'big')->orderBy('created_at', 'DESC')->paginate(8);
            return view('admin/news/big-news')->with(['news' => $news]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке всех новостей, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createNews(CreateNewsRequest $request)
    {
        try
        {
            dd($request->validated());
            $this->newsService->createNews($request->validated());
            return redirect()->back()->withSuccess('Вы успешно добавили эту новость!');

        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при создании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function showNews(News $news)
    {
        try
        {
            $relation = $news->relation;

            $relationNews = News::where('relation', $relation)->where('id', '!=', $news->id)->paginate(15);
            $comments = NewsComment::query()->where('news_id', $news->id)->orderBy('created_at', 'DESC')->withTrashed()->paginate(10);
            return view('admin/news/to-news')
                ->with(['news' => $news,'comments' =>  $comments, 'relations' => $relationNews]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при переходе на новость, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createSmallNewsPage()
    {
        try
        {
            $relations = News::query()->pluck('relation');
            return view('admin/news/small-create-page')->with(['relations' => $relations]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function createBigNewsPage()
    {
        try
        {
            $relations = News::query()->pluck('relation');
            return view('admin/news/big-create-page')->with(['relations' => $relations]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function editSmallNewsPage(News $news)
    {
        try
        {
            return view('admin/news/edit-small-news-page')->with(['news' => $news]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function editBigNewsPage(News $news)
    {
        try
        {
            return view('admin/news/edit-big-news-page')->with(['news' => $news]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function editSmallNews(News $news, EditNewsRequest $request)
    {
        try
        {
            return $this->newsService->editNews($news, $request->validated());
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function editBigNews(News $news, EditNewsRequest $request)
    {
        try
        {
            return $this->newsService->editNews($news, $request->validated());
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при редактировании новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function deleteNews(News $news)
    {
        try
        {
            $this->newsService->deleteNews($news);
            return redirect()->back()->withSuccess('Вы успешно удалили эту новость! Если вы хотите её восстановить, то воспользуйтесь корзиной.');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function deleteNewsComment(NewsComment $newsComment)
    {
        try
        {
            $this->newsService->deleteComment($newsComment);
            return redirect()->back()->withSuccess('Вы успешно удалили этот комментарий! Если вы хотите восстановить его, то воспользуйстесь корзиной.');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении комментария новости, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
