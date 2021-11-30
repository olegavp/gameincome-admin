<?php

namespace App\Http\Controllers\Admin\Appeals\General;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppeal;
use Illuminate\Http\Request;

class OpenGeneralAppealController extends Controller
{
    public function index()
    {
        try
        {
            $appeals = GeneralAppeal::query()->where('closed_at', '=',null)->orderBy('created_at', 'ASC')->paginate(15);
            return view('admin/appeals/general/open')->with(['appeals' => $appeals]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
