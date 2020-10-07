<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iglesia extends Model
{
    protected $primaryKey = 'id';
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    public function Miembros(){
        return $this->belongsToMany(User::class)->withTimestamps();
    }

    public function asignarIglesia($id){
        $this->Miembros()->sync($id, false);

    }


}
