<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Contact extends Model
{
    use HasFactory;
    use Sortable;

    // 定数
    const CLOSED = 1;
    const OPEN = 0;

    protected $fillable =
    [
        'contact_tag_id',
        'title',
        'name',
        'email',
        'body',
        'file_name',
        'file_path',
        'name',
        'status',
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
    protected function getStorageFilePathAttribute()
    {
        return storage_path("app/public/contact/$this->file_name");
    }

    public function getIsClosedAttribute()
    {
        return $this->status === self::CLOSED;
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

    public function contactTags() 
    {
        // return $this->belongsToMany('App\Models\ContactTag')->withPivot('contact_tag');
        return $this->belongsToMany(ContactTag::class);
    }
}
