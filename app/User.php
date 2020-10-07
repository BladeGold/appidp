<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'last_name', 'email', 'password', 'imagen',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst(strtolower($value));
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    public function roles(){
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function asignarRol($role){
        $this->roles()->sync($role, false);

    }

    public function tieneRol(){

        return  $this->roles->flatten()->pluck('name')->unique();

    }


    public function Pertenece(){

        return $this->belongsToMany(Iglesia::class)->withTimestamps();
    }

    public function asignarIglesia($id){
        $this->Pertenece()->sync($id, false);

    }
    public function esMiembro(){

        return  $this->Pertenece->flatten()->pluck('name')->unique();

    }

    public function userDates(){
        return $this->hasOne(UserDate::class);
    }

}
