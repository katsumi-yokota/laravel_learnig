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
        'body',
        'file_name',
        'file_path',
    ];
    public $sortable =
    [
        'title',
        'name',
        'email',
        'body',
        'file_name',
        'file_path',
    ];

    // アクセサ
    protected function getStorageFilePathAttribute(): String
    {
        $fileName = $this->file_name;
        return storage_path("app/public/contact/$fileName");
    }
}