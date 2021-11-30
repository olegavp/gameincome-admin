<?php

namespace App\Http\Controllers\Admin\Appeals\Partnership;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppealMessage;
use App\Models\AdminPanel\Appeals\Partnership\PartnershipAppealMessage;
use App\Models\AdminPanel\Appeals\Technical\TechnicalAppealMessage;
use Illuminate\Http\Request;

class GetPartnershipMessagesController extends Controller
{
    public function index($id)
    {
        try
        {
            $messages = PartnershipAppealMessage::query()
                ->where('appeal_id', $id)->orderBy('created_at', 'ASC')
                ->select('appeal_id', 'text', 'user_id', 'admin_id', 'created_at')
                ->get();

            return view('admin/appeals/partnership/to-appeal')->with(['messages' => $messages, 'appealId' => $messages->pluck('appeal_id')[0]]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
