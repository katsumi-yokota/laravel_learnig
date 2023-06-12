<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactResponse extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'response_content',
        'contact_id',
        'user_id',
    ];

    // リレーション
    public function contact()
    {
        return $this->belongsTo('App\Models\Contact');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
