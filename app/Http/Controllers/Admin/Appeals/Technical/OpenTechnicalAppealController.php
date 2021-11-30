<?php

namespace App\Http\Controllers\Admin\Appeals\Technical;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppeal;
use App\Models\AdminPanel\Appeals\Technical\TechnicalAppeal;
use Illuminate\Http\Request;

class OpenTechnicalAppealController extends Controller
{
    public function index()
    {
        try
        {
            $appeals = TechnicalAppeal::query()->where('closed_at', '=',null)->orderBy('created_at', 'ASC')->paginate(15);
            return view('admin/appeals/technical/open')->with(['appeals' => $appeals]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
