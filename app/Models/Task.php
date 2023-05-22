<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = [];

    /* Nuevo metodo */

    public function user(){ // Este esta bien
        return $this->belongsTo(User::class);
    }
}
