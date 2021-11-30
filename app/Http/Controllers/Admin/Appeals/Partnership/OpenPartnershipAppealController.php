<?php

namespace App\Http\Controllers\Admin\Appeals\Partnership;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppeal;
use App\Models\AdminPanel\Appeals\Partnership\PartnershipAppeal;
use App\Models\AdminPanel\Appeals\Technical\TechnicalAppeal;
use Illuminate\Http\Request;

class OpenPartnershipAppealController extends Controller
{
    public function index()
    {
        try
        {
            $appeals = PartnershipAppeal::query()->where('closed_at', '=',null)->orderBy('created_at', 'ASC')->paginate(15);
            return view('admin/appeals/partnership/open')->with(['appeals' => $appeals]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
