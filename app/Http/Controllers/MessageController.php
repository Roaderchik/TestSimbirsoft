<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessSendMessage;
use App\Message;
use App\MessageSender;


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
        $message = new Message($name,$email,$textmessage);
        
        \Debugbar::info($name,$email,$message,$message->toJSON());        
        $MessageSender = new MessageSender;
        $MessageSender->set($message);

        
        return  redirect()->route('message.send');
    }
    
     /**
     * Show the receive.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function receive()
    {
         $MessageSender = new MessageSender;
         $messages=$MessageSender->get();
      
        \Debugbar::info($messages); 
        return view('receive',['messages'=>$messages]);
    }

}