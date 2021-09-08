<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Notifications\Notifiable;
//use Laravel\Fortify\TwoFactorAuthenticatable;
//use Laravel\Jetstream\HasProfilePhoto;
//use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class User extends Authenticatable
{
    use softDeletes;
    protected $fillable = [
        'adsoyad',
        'email',
        'password',
        'aktivasyon_anahtar',
        'aktiv',
        'is_admin',
    ];

 
    protected $hidden = [
        'password',
        'aktivasyon_anahtar',
    ];

    public function detay()
    {
        return $this->hasOne('App\Models\Userdetay')->withDefault();//biz bir route ile hem guncellenme hem create edirik.. id >0 dan olanda guncellenmeye getdi..id gondermiyende detay bilgilerini gormur deye xeta verdi..bizde varsayilan deyeri bos etdik
    }
}

