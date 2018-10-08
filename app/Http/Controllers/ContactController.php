<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    /**
     * GET /contact-us
     * @route contact
     * @return mixed
     */
    public function show(){
        return view('contact-us');
    }

    /**
     * POST /contact-us
     * @route contact-us
     */
    public function send(Request $request){
        Mail::to(option('site_email'))->send(new ContactMail($request));
    }
}
