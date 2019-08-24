<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
     /**
     * Show the send dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function send()
    {
        return view('send');
    }

       /**
     * Store message.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request) 
    {
        $name = (string) $request->input('name','');        
        $email = (string) $request->input('email','');
        $textmessage = (string) $request->input('textmessage','');
        \Debugbar::info($name,$email,$textmessage);
        \Session::flash('status', 'Сообщение отправлено!'); 
        return  redirect()->route('message.send');
    }
    
     /**
     * Show the receive dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function receive()
    {
        return view('receive');
    }

}