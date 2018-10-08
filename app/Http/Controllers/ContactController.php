<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function show(){
        return view('contact-us');
    }

    public function send(Request $request){
        Mail::to(option('site_email'))->send(new ContactMail($request));
    }
}
