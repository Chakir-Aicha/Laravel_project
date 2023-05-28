<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PagesController extends Controller
{
    public function contact_us(){
        return view('contact');
    }

    // Save Contact Us Form
    public function save_contactus(Request $request){
        $request->validate([
            'full_name'=>'required',
            'email'=>'required',
            'subject'=>'required',
            'msg'=>'required',
        ]);

        $data = array(
            'name'=>$request->full_name,
            'email'=>$request->email,
            'subject'=>$request->subject,
            'msg'=>$request->msg,
        );

        Mail::send('contact', $data, function($message){
            $message->to('aicha.chakir.2022@gmail.com', 'Suraj Kumar')->subject('Contact Us Query');
            $message->from('aicha.chakir.2022@gmail.com','CodeArtisanLab');
        });

        return redirect('/save_contactus')->with('success','Mail has been sent.');
    }
}
