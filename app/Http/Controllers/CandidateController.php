<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use App\Models\User;
use App\Models\Cursus;
use App\Models\Language;
use App\Models\Candidate;
use App\Models\Experience;
use Illuminate\Http\Request;
use Spatie\Newsletter\Facades\Newsletter;

use function PHPUnit\Framework\countOf;

class CandidateController extends Controller
{
    public function index(){
        $id = auth()->user()->id;
        $data = Candidate::where('user_id' , $id)->get();
        if(count($data)>0){
            $cv = Cv::where('candidate_id' , $data[0]->id)->first();
            return view('candidate' , ['data'=>$data , 'cv'=>$cv]);
        }else{

            return view('candidate');
        }
    }
    public function subscribe(Request $request)
    {  
        if(!Newsletter::isSubscribed($request->email)){
         Newsletter::subscribe($request->email);
     }
     return redirect()->back();
    }

    public function DeleteCv(Request $request){
        $id = $request->cv_id;
        $cv = Cv::where('id' , $id)->first();
        if($cv){
            $cv->delete();
            $token = 0 ;
            $this->update_Cv_token($token);
        }
        return $this->index();
    }
    public function update_Cv_token($token){
        $id = auth()->user()->id;
        User::where('id', $id)->update(['hasCv' => $token]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id'=> ['required'],
            'email' => ['required'],
            'name' => ['required'],
            'photo' => ['required'],
            'titre' => ['required', 'string', 'max:255'],
            'current_position' => ['required', 'string', 'max:255'],
            'industry' => ['required', 'string'] , 
            'address' => ['required', 'string'] , 
            'about' => ['required', 'string'] , 
        ]);
        $photo = time().'.'.$request->photo->extension(); 
        $request->photo->move(public_path('images'), $photo);

        $candidate = Candidate::create(
            [
                'user_id'=> $request->user_id,
                'email' => $request->email,
                'name' => $request->name,
                'photo' => $photo,
                'titre' => $request->titre,
                'current_position' => $request->current_position,
                'industry' => $request->industry , 
                'address' =>$request->address , 
                'about' => $request->about , 
            ]
        );
        $update = new EnterpriseController() ; 
        $update->update_token();
        return to_route('profile.candidate');
    }
    
    public function storeCv(Request $request)
    {
    $userId = auth()->user()->id;
    $candidate = Candidate::where('user_id' , $userId)->first();

    $photo = time().'.'.$request->cvphoto->extension(); 
    $request->cvphoto->move(public_path('images'), $photo);
    
    $request->validate([
        'name'=> ['required' ,'string'],
        'email' => ['required'],
        'name' => ['required','string'],
        'skills' => ['required', 'string'],
    ]);

    $cv = Cv::create([
        'name' =>$request->name ,
        'email' => $request->email ,
        'photo' =>$photo ,
        'skills' => $request->input('skills'),
        'candidate_id' => $candidate->id]);

    // $languages = $request->input('languages');
    // foreach ($languages as $language) {
    Language::create([
        'name' => $request->input('langname'),
        'proficiency' => $request->input('proficiency'),
        'cv_id' => $cv->id,
    ]);
    // }

    //  Experience
    // $experiences = $request->input('experiences');
    // foreach ($experiences as $experience) {
    Experience::create([
        'poste' => $request->input('poste'),
        'company' => $request->input('company'),
        'start_date_exp' => $request->input('start_date_exp'),
        'end_date_exp' => $request->input('end_date_exp'),
        'cv_id' => $cv->id,
    ]);
    // }

    //  Cursus
    // $cursuses = $request->input('cursuses');
    // foreach ($cursuses as $cursus) {
    Cursus::create([
        'diplome' => $request->input('diplome'),
        'school' => $request->input('school'),
        'start_date_school' => $request->input('start_date_school'),
        'end_date_school' => $request->input('end_date_school'),
        'cv_id' => $cv->id,
    ]);
    // }
    $token = 1 ;
       $this->update_Cv_token($token);
       return to_route('profile.candidate');
    }
}
