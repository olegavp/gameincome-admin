<?php

namespace App\Http\Controllers\Admin\Appeals\Dispute;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\Dispute\DisputeAppealMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendDisputeMessageController extends Controller
{
    public function send(Request $request, $id)
    {
        try
        {
            $newMessage = new DisputeAppealMessage;
            $newMessage->appeal_id = $id;
            $newMessage->user_id = null;
            $newMessage->admin_id = Auth::user()->id;
            $newMessage->text = $request->text;
            $newMessage->save();

            return redirect()->back();
        }
        catch (\Throwable $e)
        {
            return $e;
        }
    }
}
