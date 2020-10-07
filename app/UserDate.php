<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class UserDate extends Model
{
    protected $table = 'users_date';
    protected $primaryKey = 'user_id';

    public function setLugarNacimientoAttribute($value)
    {
        $this->attributes['lugar_nacimiento'] = ucfirst(strtolower($value));
    }
    public function setCiudadAttribute($value)
    {
        $this->attributes['ciudad'] = ucfirst(strtolower($value));
    }
    public function setEstadoAttribute($value)
    {
        $this->attributes['estado'] = ucfirst(strtolower($value));
    }
    public function setDireccionAttribute($value)
    {
        $this->attributes['direccion'] = ucfirst(strtolower($value));
    }
    public function setNacionalidadAttribute($value)
    {
        $this->attributes['nacionalidad'] = ucfirst(strtolower($value));
    }
    public function setEstadoCivilAttribute($value)
    {
        $this->attributes['estado_civil'] = ucfirst(strtolower($value));
    }
    public function setSexoAttribute($value)
    {
        $this->attributes['sexo'] = ucfirst(strtolower($value));
    }

    public function userDates(){
        return $this->belongsTo(User::class);
    }

}
