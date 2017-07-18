<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;

class ContactUsController extends Controller
{
    public function contactUs(Request $request)
    {
        $this->validate($request,[
            'senderName'  => 'required|regex:/^[a-zA-Z .,]+$/',
            'senderEmail' => 'required|email|regex:/^[0-9a-z.@]+$/',
            'subject'     => 'required|regex:/^[0-9a-zA-Z .,_()@!:&-\\/]+$/|max:100',
            'messages'    => 'required|regex:/^[0-9a-zA-Z !@#&*?()-_+:,.\\/]+$/|max:500',
            'g-recaptcha-response' => 'required|captcha'
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
                'g-recaptcha-response.required' => 'Verify that you are not a Robot'
            ]);

        $ip = $request->ip();

        Mail::to('champrohan123@gmail.com')->send(new ContactUsMail($request->senderName,$request->senderEmail,$request->subject,$request->messages, $ip));

        return response()->json([
            'status' => 'success'
        ]);
    }
}
