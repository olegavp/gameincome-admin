<?php

namespace App\Http\Controllers\Admin\Trash;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdminPanel\News\NewsCommentResource;
use App\Http\Resources\AdminPanel\News\Trash\NewsCommentForTrashResource;
use App\Http\Resources\AdminPanel\News\Trash\NewsForTrashResource;
use App\Http\Resources\AdminPanel\News\Trash\ShortNewsCommentForTrashResource;
use App\Http\Resources\AdminPanel\News\Trash\ShortNewsForTrashResource;
use App\Http\Resources\AdminPanel\User\Trash\ShortUserBannedForTrashResource;
use App\Http\Resources\AdminPanel\User\UserBannedResource;
use App\Models\AdminPanel\News\News;
use App\Models\AdminPanel\News\NewsComment;
use App\Models\AdminPanel\PromoCode\PromoCode;
use App\Models\AdminPanel\User\UserBanned;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TrashController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/trash-box/index');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function newsList()
    {
        try
        {
            $news = News::query()->onlyTrashed()->orderBy('created_at', 'DESC')->paginate(8);
            return view('admin/trash-box/news/index')->with(['news' => $news]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function toNews($id)
    {
        try
        {
            $news = News::query()->onlyTrashed()->where('id', $id)->first();

            $comments = NewsComment::query()->where('news_id', $news->id)->orderBy('created_at', 'DESC')->withTrashed()->paginate(10);
            return view('admin/trash-box/news/to')
                ->with(['news' => $news,'comments' =>  $comments]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function restoreNews($id)
    {
        try
        {
            News::query()->onlyTrashed()->where('id', $id)->restore();
            return redirect()->back()->withSuccess('Вы успешно восстановили эту новость!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function commentsList()
    {
        try
        {
            $comments = NewsComment::query()->onlyTrashed()->orderBy('created_at', 'DESC')->paginate(15);
            return view('admin/trash-box/news-comments/index')->with(['comments' => $comments]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function toComment($id)
    {
        try
        {
            $comment = NewsComment::query()->onlyTrashed()->where('id', $id)->first();
            $news = News::query()->withTrashed()->where('id', $comment->news_id)->first();

            return view('admin/trash-box/news-comments/to')->with(['comment' => $comment, 'news' => $news]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function restoreComment($id)
    {
        try
        {
            NewsComment::query()->onlyTrashed()->where('id', $id)->restore();
            return redirect()->back()->withSuccess('Вы успешно восстановили этот комментарий к новости!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function promoCodesList()
    {
        try
        {
            $promoCodes = PromoCode::query()->onlyTrashed()->orderBy('created_at', 'DESC')->paginate(15);
            return view('admin/trash-box/promo-codes/index')->with(['promoCodes' => $promoCodes]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function restorePromoCode($id)
    {
        try
        {
            $promoCode = PromoCode::query()->onlyTrashed()->where('id', $id)->first();
            if ($promoCode->finish_time <= Carbon::now() and $promoCode->finish_time != null)
            {
                $nowDatePlusMonth = Carbon::now()->addMonth();
                $promoCode->finish_time = $nowDatePlusMonth;
                $promoCode->save();
            }

            $promoCode->restore();
            return redirect()->back()->withSuccess('Вы успешно восстановили данный промокод!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function usersList()
    {
        try
        {
            $bannedUsers = UserBanned::query()->orderBy('created_at', 'DESC')->pluck('user_id');
            $bannedUsers = User::query()->whereIn('id', $bannedUsers)->paginate(15);
            return view('admin/trash-box/banned-users/index')->with(['users' => $bannedUsers]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }


    public function unbanUser($id)
    {
        try
        {
            UserBanned::query()->where('user_id', $id)->delete();
            return redirect()->back()->withSuccess('Вы успешно разюлокировали данного пользователя!');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e->getMessage()]);
        }
    }
}
