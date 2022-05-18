<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactEmail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }
    public function store()
    {
        $data = array();
        $data['error'] = [];
        $data['success'] = 0;
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'subject' => 'required|min:5|max:50',
            'message' => 'required|min:5|max:500',
        ];

        $validate = Validator::make(request()->all(), $rules);

        if ($validate->fails()) {
            $data['error'][] = $validate->errors()->first('first_name');
            $data['error'][] = $validate->errors()->first('last_name');
            $data['error'][] = $validate->errors()->first('email');
            $data['error'][] = $validate->errors()->first('subject');
            $data['error'][] = $validate->errors()->first('message');
            $data['message'] = 'Please check the form';
        } else {
            $attribute = $validate->validated();
            $data['success'] = 1;
            $data['message'] = 'Thank you for contacting us. We will get back to you as soon as possible.';
            $contact = Contact::create($attribute);
            // Mail::to(env('MAIL_TO_ADMIN'))->send(new ContactEmail($contact));
        }
        return response()->json($data);
    }
}
