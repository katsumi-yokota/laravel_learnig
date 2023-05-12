<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
    use HasFactory;
    use Sortable;

    protected $fillable =
    [
        'title',
        'name',
        'email',
        'body'
    ];
    public $sortable =
    [
        'title',
        'name',
        'email',
        'body'
    ];
}