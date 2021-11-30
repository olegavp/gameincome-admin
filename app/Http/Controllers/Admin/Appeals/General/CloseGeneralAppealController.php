<?php

namespace App\Http\Controllers\Admin\Appeals\General;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppeal;
use Illuminate\Support\Carbon;

class CloseGeneralAppealController extends Controller
{
    public function closeAppeal($id)
    {
        try
        {
            $generalAppeal = GeneralAppeal::query()->find($id);
            $generalAppeal->update(['closed_at' => Carbon::now()]);

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
            $appeals = GeneralAppeal::query()->where('closed_at', '!=',null)->orderBy('created_at', 'ASC')->paginate(15);
            return view('admin/appeals/general/close')->with(['appeals' => $appeals]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
