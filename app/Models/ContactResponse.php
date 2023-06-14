<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Integer;

class ContactResponse extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable =
    [
        'response_content',
        'contact_id',
        'user_id',
        'status',
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
