<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer_Candidate extends Model
{
    use HasFactory;
    protected $table = 'offers_candidates' ;
    protected $fillable = [
        'offer_id',
        'candidate_id',
    ];
    public function offer(){
        return $this->belongsTo(Offer::class);
    }
    public function candidate(){
        return $this->belongsTo(Candidate::class);
    }
}
