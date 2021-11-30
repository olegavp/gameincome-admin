<?php

namespace App\Http\Controllers\Admin\Appeals\Dispute;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\Dispute\DisputeAppeal;
use Illuminate\Http\Request;

class GetDisputeAppealController extends Controller
{
    public function index()
    {
        try
        {
            return view('admin/appeals/dispute/index');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
