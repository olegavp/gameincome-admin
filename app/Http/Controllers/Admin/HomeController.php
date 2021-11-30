<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(): Factory|View|Application
    {
        $sellersCount = DB::table('sellers')->count();
        $usersCount = DB::table('users')->count();
        return view('admin/home/index', ['countOfSeller' => $sellersCount, 'countOfUsers' => $usersCount]);
    }
}
