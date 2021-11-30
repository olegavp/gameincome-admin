<?php

namespace App\Http\Controllers\Admin\Appeals\General;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppealMessage;
use Illuminate\Http\Request;

class GetGeneralMessagesController extends Controller
{
    public function index($id)
    {
        try
        {
            $messages = GeneralAppealMessage::query()
                ->where('appeal_id', $id)->orderBy('created_at', 'ASC')
                ->select('appeal_id', 'text', 'user_id', 'admin_id', 'created_at')
                ->get();

            return view('admin/appeals/general/to-appeal')->with(['messages' => $messages, 'appealId' => $messages->pluck('appeal_id')[0]]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
