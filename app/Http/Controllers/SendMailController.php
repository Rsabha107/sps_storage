<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use App\Mail\SampleMail;

class SendMailController extends Controller
{
    //
    public function index()
    {
        $content = [
            'subject' => 'Traki: Event monitoring reminder',
            'body' => 'You have an event/task that needs your attention.  Ya walad!!!'
        ];

        Mail::to('rsabha@gmail.com')->cc('rsabha@gmail.com')->send(new SampleMail($content));

        return "Email has been sent.";
    }

}
