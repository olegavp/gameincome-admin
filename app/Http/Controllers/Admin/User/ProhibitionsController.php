<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\User\UserBanned;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProhibitionsController extends Controller
{
    public function ban(User $user)
    {
        try
        {
            $userBanned = new UserBanned;
            $userBanned->user_id = $user->id;
            $userBanned->cause = '32131';
            $userBanned->save();
            return redirect()->back()->withSuccess('Вы добавили данного пользователя в чёрный список бессрочно, чтобы разблокировать данного пользователя, перейдите в корзину.');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }


    public function unban(User $user)
    {
        try
        {
            $userBanned = UserBanned::query()->where('user_id', $user->id)->withTrashed()->first();
            if ($userBanned == null)
            {
                return response()->json(['message' => 'Данный пользователь не находится в блокировке!']);
            }

            $userBanned->forceDelete();
            return redirect()->back()->withSuccess('Вы удалили данного пользователя из чёрного списка.');
        }
        catch (\Throwable $e)
        {
            return response()->json(['message' => 'Произошла ошибка: ' . $e]);
        }
    }
}
