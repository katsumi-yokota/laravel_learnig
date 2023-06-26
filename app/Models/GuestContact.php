<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestContact extends Model
{
    use HasFactory;
    
    const GUEST = 0;

    public function contactResponses()
    {
        return $this->hasMany('App\Models\ContactResponse');
    }
}
