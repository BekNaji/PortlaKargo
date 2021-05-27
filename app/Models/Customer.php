<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public function phone()
    {
        if(strlen($this->phone) == 12)
        {
            return substr($this->phone,2,-1);
        }
        if(strlen($this->phone) == 11)
        {
            return substr($this->phone,1,-1);
        }
        return $this->phone ?? '';
    }
}
