<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $fillable = [
        'poste',
        'company',
        'start_date_exp',
        'end_date_exp',
        'cv_id',
    ];
    public function cv(){
        return $this->belongsTo(Cv::class);
    }
}

