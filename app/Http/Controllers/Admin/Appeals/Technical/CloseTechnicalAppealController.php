<?php

namespace App\Http\Controllers\Admin\Appeals\Technical;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppeal;
use App\Models\AdminPanel\Appeals\Technical\TechnicalAppeal;
use Illuminate\Support\Carbon;

class CloseTechnicalAppealController extends Controller
{
    public function closeAppeal($id)
    {
        try
        {
            $technicalAppeal = TechnicalAppeal::query()->find($id);
            $technicalAppeal->update(['closed_at' => Carbon::now()]);

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
            $appeals = TechnicalAppeal::query()->where('closed_at', '!=',null)->orderBy('created_at', 'ASC')->paginate(15);
            return view('admin/appeals/technical/close')->with(['appeals' => $appeals]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
