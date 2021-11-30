<?php

namespace App\Http\Controllers\Admin\Appeals\Partnership;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GetPartnershipAppealController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/appeals/partnership/index');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
