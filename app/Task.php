<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'user_id'];



    public function userId()
    {
        // fonction userId qui nous fait une petite jointure entre la tâche et l'utilisateur
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}

