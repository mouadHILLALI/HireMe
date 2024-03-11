<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Enterprise;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $users = User::where('role' , '<>' , 'ADMIN')->get();
        $offers = Offer::get();
        return view('admin' , ['users'=>$users , 'offers'=>$offers]);
    }
    public function stats(){
        $companies = Enterprise::count();
        $candidates = Candidate::count();
        $offers = Offer::count();
        return view('stats' , ['companies'=>$companies , 'candidates'=>$candidates , 'offers'=>$offers]);
    }
    public function destroy(Request $request){
        $id = $request->id ; 
        $user = User::find($id);
        if($user){
            $user->Delete();
        }else{
            $offer = Offer::find($id);
            $offer->Delete();
        }
        return $this->index();
    }
}
