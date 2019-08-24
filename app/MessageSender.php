<?php

namespace App;

class MessageSender
    {
        public function set(Message $message) {
            \Amqp::publish('routing-key', $message->toJSON() , ['queue' => 'queue-name']);
            \Session::flash('status',  'Сообщение отправлено!');
        }
        public function get() {
            $messages=[];

            \Amqp::consume('queue-name', function ($message, $resolver)  use (&$messages) {
                $messages[]=json_decode($message->body);               
                $resolver->acknowledge($message);
                $resolver->stopWhenProcessed();
            });            
            return $messages;
        }
    }