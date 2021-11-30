<?php

namespace App\Http\Controllers\Admin\Appeals\Technical;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetTechnicalAppealController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/appeals/technical/index');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
