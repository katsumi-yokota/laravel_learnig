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
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $dates = [
        'deleted_at'
    ]; // 論理削除

    public $sortable =[
        'name',
        'email',
        'password',
    ]; // ソート

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
}
