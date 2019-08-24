<?php

namespace App;


class Message 
{
    //
    public $name,$email,$textmessage;

    public function __construct($name,$email,$textmessage) {
        $this->name = $name;
        $this->email = $email;
        $this->textmessage = $textmessage;
      }

    public function expose() {
        return get_object_vars($this);
    }

    public function toJSON() {
        return   json_encode($this->expose());
    }
  

}
