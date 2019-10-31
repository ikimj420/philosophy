<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Flash;
use Auth;

class ContactController extends Controller
{

    public function create()
    {
        return view('contact.create');
    }

    public function store(Request $request)
    {
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Mail::to('philosphy@test.com')->send(new ContactMail($data));

        Flash::success('Messages send.');

        return back();
    }
}
