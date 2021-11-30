<?php

namespace App\Http\Controllers\Admin\Appeals\Dispute;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\Dispute\DisputeAppealMessage;
use Illuminate\Http\Request;

class GetDisputeMessagesController extends Controller
{
    public function index($id)
    {
        try
        {
            $messages = DisputeAppealMessage::query()
                ->where('appeal_id', $id)->orderBy('created_at', 'ASC')
                ->select('appeal_id', 'text', 'user_id', 'admin_id', 'path_to_image', 'created_at')
                ->get();

            return view('admin/appeals/dispute/to-appeal')->with(['messages' => $messages, 'appealId' => $messages->pluck('appeal_id')[0]]);
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
