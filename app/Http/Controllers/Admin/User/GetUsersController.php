<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class GetUsersController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/users/search-user');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }


    public function search(Request $request)
    {
        try
        {
            $user = User::query()->where('email', $request->email)->first();

            if ($user == null)
            {
                return redirect()->back()->withError('Пользователя с данным email не существует!');
            }

            return view('admin/users/found-user')->with(['user' => $user]);
        }
        catch (\Throwable)
        {

        }
    }
}
