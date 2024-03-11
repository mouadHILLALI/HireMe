<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\Offer;
use App\Models\User;
use Illuminate\Http\Request;

class EnterpriseController extends Controller
{
    public function index(){
        $enterprise = Enterprise::where('user_id' , auth()->user()->id)->get();
        return view('profile/profile-enterprise' , ['enterprise'=>$enterprise]);
    }
    public function update_token(){
        $id = auth()->user()->id;
        User::where('id', $id)->update(['confirm' => 1]);
    }

    public function return_to_view(){
        $id = auth()->user()->id;
        $ent = Enterprise::where('user_id' , $id)->first();
        $ent_id = $ent->id;
        $offers = Offer::where('enterprise_id' , $ent_id)->get();
        if($offers){
            return view('/enterprise' , ['offers'=>$offers]);
        }else{
            return view('/enterprise');
        }
    }
    public function store(Request $request){
     $request->validate([
            'user_id'=>['required'] , 
            'email'=>['required'] ,
            'name'=>['required'] ,
            'logo'=>['required'],
            'slogan'=>['required' , 'string' , 'max:255'] , 
            'industrie'=>['required' , 'string' , 'max:255'] ,
            'description' =>['required' , 'string']
        ]);
        $logo =time().'.'.$request->logo->extension(); 
        $request->logo->move(public_path('images'), $logo);
        $enterprise = Enterprise::create([
            'user_id'=>$request->user_id , 
            'email'=>$request->email ,
            'name'=>$request->name ,
            'logo'=>$logo,
            'slogan'=>$request->slogan, 
            'industrie'=>$request->industrie ,
            'description' =>$request->description
        ]);
        $this->update_token();
        return redirect('/profile/enterprise');
    }
    public function storeOffer(Request $request){
        $id = auth()->user()->id;
        $ent = Enterprise::where('user_id' , $id )->firstOrFail();
        $ent_id = $ent->id;
        $offer = Offer::create([
            'enterprise_id' =>$ent_id ,
            'title' => $request->title,
            'skills' =>$request->skills ,
            'description' => $request->input('description'),
            'Contract' => $request->input('Contract'),
            'Location'=>$request->input('Location')
            ] );

       return $this->return_to_view();
    }
}
