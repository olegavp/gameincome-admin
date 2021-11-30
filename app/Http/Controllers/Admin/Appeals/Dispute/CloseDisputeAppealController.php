<?php

namespace App\Http\Controllers\Admin\Appeals\Dispute;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\Dispute\DisputeAppeal;
use Carbon\Carbon;

class CloseDisputeAppealController extends Controller
{
    public function closeAppeal($id)
    {
        try
        {
            $disputeAppeal = DisputeAppeal::query()->find($id);
            $disputeAppeal->update(['closed_at' => Carbon::now()]);

            return redirect()->back()->withSuccess('Вы успешно закрыли данное обращение');
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }


    public function index()
    {
        try
        {
            $appeals = DisputeAppeal::query()->where('closed_at', '!=',null)->orderBy('created_at', 'ASC')->paginate(15);
            return view('admin/appeals/dispute/close')->with(['appeals' => $appeals]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
