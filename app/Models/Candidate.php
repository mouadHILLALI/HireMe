<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'photo',
        'titre',
        'current_position',
        'industry',
        'address',
        'about'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
