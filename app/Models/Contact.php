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
        'contact_category_id',
        'title',
        'name',
        'email',
        'body',
        'file_name',
        'file_path',
        'name',
    ];
    public $sortable =
    [
        'title',
        'name',
        'email',
        'body',
        'file_name',
        'file_path',
        'name',
    ];

    // アクセサ
    protected function getStorageFilePathAttribute(): String
    {
        $fileName = $this->file_name;
        return storage_path("app/public/contact/$fileName");
    }

    // リレーション
    public function contactCategory()
    {
        return $this->belongsTo('App\Models\ContactCategory');
    }

    public function contactResponses()
    {
        return $this->hasMany('App\Models\ContactResponse');
    }
}
