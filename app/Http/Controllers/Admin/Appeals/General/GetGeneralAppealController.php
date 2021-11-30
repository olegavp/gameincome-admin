<?php

namespace App\Http\Controllers\Admin\Appeals\General;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetGeneralAppealController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/appeals/general/index');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
