<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function users(){
        return $this->belongsToMany(User::class);
    }

    /* Nuevo metodo */
    /* public function tasks(){
        return $this->belongsToMany(User::class);
    } */
}
