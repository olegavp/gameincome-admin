<?php

namespace App\Http\Controllers\Admin\Appeals\Partnership;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\Partnership\PartnershipAppeal;
use Illuminate\Support\Carbon;

class ClosePartnershipAppealController extends Controller
{
    public function closeAppeal($id)
    {
        try
        {
            $partnershipAppeal = PartnershipAppeal::query()->find($id);
            $partnershipAppeal->update(['closed_at' => Carbon::now()]);

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
            $appeals = PartnershipAppeal::query()->where('closed_at', '!=',null)->orderBy('created_at', 'ASC')->paginate(15);
            return view('admin/appeals/partnership/close')->with(['appeals' => $appeals]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
