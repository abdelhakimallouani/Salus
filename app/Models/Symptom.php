<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Symptom extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'severity',
        'description',
        'date_added',
        'notes',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
