<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\News\NewsComment;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserInfoController extends Controller
{
    public function index(User $user)
    {
        try
        {
            $sellerId = DB::table('sellers')->where('user_id', $user->id)->first()->id;
            if ($sellerId != null)
            {
                $feedbacks = DB::table('sellers_feedbacks')->where('seller_id', $sellerId)->get();
                $likes = $feedbacks->where('rate', 1)->count();
                $dislikes = $feedbacks->where('rate', 0)->count();
                $purchases = DB::table('purchases')->where('seller_id', $sellerId)->count();
                $sales = DB::table('game_keys')->where('seller_id', $sellerId)->count() + DB::table('software_keys')->where('seller_id', $sellerId)->count();
                return view('admin/users/to-user', ['user' => $user, 'likes' => $likes, 'dislikes' => $dislikes,
                    'purchases' => $purchases, 'sales' => $sales]);
            }
            else
            {
                return view('admin/users/to-user', ['user' => $user]);
            }

        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке страницы пользователя, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function userComments(User $user)
    {
        try
        {
            $comments = NewsComment::query()->where('user_id', $user->id)->orderBy('created_at', 'DESC')->withTrashed()->paginate(10);
            return view('admin/users/user-comments-news', ['comments' => $comments]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке комментариев новостей, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function userSessions(User $user)
    {
        try
        {
            $sessions = DB::table('users_ip')->where('user_id', $user->id)->get();
            return view('admin/users/user-sessions', ['sessions' => $sessions]);
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при загрузке сессий, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function deleteUserSessions($id)
    {
        try
        {
            $ip = DB::table('users_ip')->where('id', $id)->first();
            DB::table('personal_access_tokens')->where('id', $ip->token_id)->delete();
            DB::table('users_ip')->where('id', $id)->delete();
            return redirect()->back()->withSuccess('Вы успешно завершили данную сессию пользователя');
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении сессии, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }


    public function sellerFedbacks(User $user)
    {
        try
        {
            $sellerId = DB::table('sellers')->where('user_id', $user->id)->first()->id;
            $feedbacks = DB::table('sellers_feedbacks')->where('seller_id', $sellerId)->orderBy('created_at', 'DESC')->get();
            if ($feedbacks != null)
            {
                return view('admin/users/seller-feedback', ['feedbacks' => $feedbacks]);
            }
            return redirect()->back();
        }
        catch (\Throwable $e)
        {
            return response()->json(['error' => 'Произошла ошибка при удалении сессии, пожалуйста, обратитесь к разработчику, Спасибо! Текст ошибки: ' . $e,
                'status' => 400], 400);
        }
    }
}
