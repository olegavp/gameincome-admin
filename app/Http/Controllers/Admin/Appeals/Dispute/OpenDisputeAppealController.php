<?php

namespace App\Http\Controllers\Admin\Appeals\Dispute;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\Dispute\DisputeAppeal;
use Illuminate\Http\Request;

class OpenDisputeAppealController extends Controller
{
    public function index()
    {
        try
        {
            $appeals = DisputeAppeal::query()->where('closed_at', '=',null)->orderBy('created_at', 'ASC')->paginate(15);
            return view('admin/appeals/dispute/open')->with(['appeals' => $appeals]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
