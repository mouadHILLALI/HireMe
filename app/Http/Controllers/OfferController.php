<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Offer;
use App\Models\Offer_Candidate;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function destroy($id){
        $offer = Offer::where('id' , $id);
        if($offer){
            $offer->delete();
            return to_route('enterprise.home')->with('success' , 'Offer Deleted Successfully');
           }else{
               return to_route('enterprise.home')->with('failed' , 'unable to delete the offer');
           }
    }
    public function checkOffer($id){
        $id = (int)$id;
        $user = Candidate::where('user_id' , auth()->user()->id)->first();
        $user_id = $user->id ;
        $check = Offer_Candidate::where('offer_id' , $id)->where('candidate_id' , $user_id)->first(); 
        if($check){
            $alreadyApplied = $check->candidate_id; 
            if($alreadyApplied){
                return true ; 
            }else{
                return false ;
            }
        }else{
            return false ;
        }
    }
    public function ConsultCandidates($id){
        $candidates = Offer_Candidate::where('offer_id' , $id)->get();
        return view('candidates-offers' , ['candidates'=>$candidates]);
    }
    public function JobOffers(){
        $offers = Offer::get();
        return view('joboffers' , ['offers'=>$offers]);
    }
    public function JobOffer($id){
        $offer = Offer::where( 'id', $id)->get();
        $result =  $this->checkOffer($id);
        if($result){
            $notexist =  1 ;
            return view('joboffer' , ['offer'=>$offer , 'notexist'=>$notexist]);
        }else{
            $notexist = 0 ; 
            return view('joboffer' , ['offer'=>$offer , 'notexist'=>$notexist]);
        }
    }

    public function StoreApplication(Request $request){
        $id = auth()->user()->id ;
        $candidate = Candidate::where('user_id', $id)->firstOrFail();
        $offer_id = $request->id ;
        Offer_Candidate::create([
                'candidate_id' => $candidate->id ,
                'offer_id' => $offer_id ,
            ]);
        return to_route('job.offers')->with('applied' , 'you have applied succesfully');
    }
}
