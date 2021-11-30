<?php

namespace App\Http\Controllers\Admin\Appeals\General;

use App\Http\Controllers\Controller;
use App\Models\AdminPanel\Appeals\General\GeneralAppealMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SendGeneralMessageController extends Controller
{
    public function send(Request $request, $id)
    {
        try
        {
            $newMessage = new GeneralAppealMessage;
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
