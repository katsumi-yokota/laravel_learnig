<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactTag extends Model
{
    use HasFactory;

    protected $fillable = [
        'contact_tag',
    ];

    // リレーション
    public function contacts() 
    {
        return $this->belongsToMany(Contact::class);
    }
}
