<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Candidate;
use App\Models\Candidate as ModelsCandidate;
use App\Models\Cursus;
use App\Models\Cv;
use App\Models\Experience;
use App\Models\Language;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CvController extends Controller
{
    public function index(){
        $id = auth()->user()->id ;
        $candidate = ModelsCandidate::where( 'user_id' ,$id)->firstOrFail() ; 
        $cv = Cv::where( 'candidate_id' ,$candidate->id)->firstOrFail() ; 
        $experience = Experience::where( 'cv_id' ,$cv->id)->firstOrFail();
        $cursus = Cursus::where( 'cv_id',$cv->id)->firstOrFail();
        $language = Language::where('cv_id' , $cv->id )->firstOrFail();
        return view('cv' , ['cv'=>$cv , 'experience'=>$experience , 'cursus'=>$cursus , 'language'=>$language , 'candidate'=>$candidate]);
    }
    public function downloadCv(){
        $id = auth()->user()->id ;
        $candidate = ModelsCandidate::where('user_id',$id)->firstOrFail();
        $cv = Cv::where( 'candidate_id' ,$candidate->id)->firstOrFail() ; 
        $experience = Experience::where( 'cv_id' ,$cv->id)->firstOrFail();
        $cursus = Cursus::where( 'cv_id',$cv->id)->firstOrFail();
        $language = Language::where('cv_id' , $cv->id )->firstOrFail();
        $pdf = Pdf::loadView('cv' ,  ['cv'=>$cv , 'experience'=>$experience , 'cursus'=>$cursus , 'language'=>$language , 'candidate'=>$candidate]);
        return $pdf->download('cv.pdf');    
    }
    
}
