<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Kyslik\ColumnSortable\Sortable; // ソート
use Illuminate\Database\Eloquent\SoftDeletes; // 論理削除

class User extends Authenticatable
{
    use SoftDeletes; // 論理削除

    use HasApiTokens, HasFactory, Notifiable;

    use Sortable; // ソート

    // 定数
    const ADMIN = 1;
    const NOTADMIN = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'privilege',
    ];

    // 論理削除
    // protected $dates = [
    //     'deleted_at'
    // ]; // deleted_atカラムを日付型として扱う

    // ソート
    public $sortable =[
        'name',
        'email',
        'password',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // リレーション
    public function contactResponses()
    {
        return $this->hasMany('App\Models\ContactResponse');
    }

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
}
