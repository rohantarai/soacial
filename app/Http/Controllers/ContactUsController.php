<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendActivationEmail;
use Illuminate\Support\Facades\DB;

class ContactUsController extends Controller
{
    public function contactUs(Request $request)
    {
        $this->validate($request,[
            'senderName'  => 'required|regex:/^[a-zA-Z .,]+$/',
            'senderEmail' => 'required|email|regex:/^[0-9a-z.@]+$/',
            'subject'     => 'required|regex:/^[0-9a-zA-Z .,_()@!:&-\\/]+$/|max:100',
            'messages'    => 'required|regex:/^[0-9a-zA-Z !@#&*?()-_+:,.\\/]+$/|max:500',
        ],
            [
                'senderName.required'  => 'Full name is required',
                'senderName.regex'     => 'Invalid Full name',
                'senderEmail.required' => 'Email id is required',
                'senderEmail.email'    => 'Email is not valid',
                'subject.required'     => 'Subject is required',
                'subject.regex'        => 'Invalid subject',
                'subject.max'          => 'Subject should not exceed 100 characters',
                'messages.required'    => 'Message is required',
                'messages.regex'       => 'Invalid message',
                'messages.max'         => 'Message should not exceed 100 characters',
            ]);

        $ip = $request->ip();

        //If the queue is empty then delay is 0 sec.
        //If the queue has Y items then next item will be delayed by (Y*15) sec, i.e., 15 sec from the last item.
        //$delay = DB::table('jobs')->count()*15;

        //$queue = (new SendActivationEmail($request->senderName,$request->senderEmail,$request->subject,$request->messages, $ip));

        //$this->dispatch($queue->delay($delay));

        //Mail::send(new ContactUsMail($request->senderName,$request->senderEmail,$request->subject,$request->messages, $ip));

        return response()->json([
            'status' => 'success'
        ]);
    }
}
