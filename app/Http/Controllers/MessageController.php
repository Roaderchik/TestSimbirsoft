<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jobs\ProcessSendMessage;
use App\Message;


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
        $message = new Message();
        $message->textmessage=  $textmessage;
        $message->email=$email;
        $message->name=$name;
        \Debugbar::info($name,$email,$message,now()->addMinutes(10));
        ProcessSendMessage::dispatch($message)->delay(now()->addMinutes(10));

        

        $job = (new ProcessSendMessage($message))
        ->delay(now()->addMinutes(1));

        dispatch($job);

        \Session::flash('status', 'Сообщение отправлено!'); 
        return view('send');
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