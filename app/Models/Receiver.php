<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    
    public function phone()
    {
        if(strlen($this->phone) == 12)
        {
            return substr($this->phone,3,-1);
        }
        return $this->phone ?? '';  
    }

    public function other_phone()
    {
        if(strlen($this->other_phone) == 12)
        {
            return substr($this->other_phone,3,-1);
        } 
        return $this->other_phone ?? '';
    }
}
