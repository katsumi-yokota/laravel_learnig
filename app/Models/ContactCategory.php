<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactCategory extends Model
{
    use HasFactory;

    // リレーション
    public function contacts()
    {
        return $this->hasMany("App\Models\Contact");
        // return $this->hasMany("App\Contact");
    }
}
