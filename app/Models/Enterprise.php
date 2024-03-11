<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enterprise extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'logo',
        'slogan',
        'industrie',
        'description',
    ];
    public function offer(){
        return $this->hasMany(Offer::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
