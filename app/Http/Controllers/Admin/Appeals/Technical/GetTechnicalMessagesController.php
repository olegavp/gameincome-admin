<?php

namespace App\Http\Controllers\Admin\Appeals\Technical;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppealMessage;
use App\Models\AdminPanel\Appeals\Technical\TechnicalAppealMessage;
use Illuminate\Http\Request;

class GetTechnicalMessagesController extends Controller
{
    public function index($id)
    {
        try
        {
            $messages = TechnicalAppealMessage::query()
                ->where('appeal_id', $id)->orderBy('created_at', 'ASC')
                ->select('appeal_id', 'text', 'user_id', 'admin_id', 'created_at')
                ->get();

            return view('admin/appeals/technical/to-appeal')->with(['messages' => $messages, 'appealId' => $messages->pluck('appeal_id')[0]]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
