<?php

namespace App\Http\Controllers;

use App\Models\Enterprise;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function reroute()
    {

        if (Auth::id()) {
            $role = auth()->user()->role;
            if ($role == 'ADMIN') {
                return to_route('profile.admin');
            } elseif ($role == 'Candidate') {
                return to_route('profile.candidate');
            } elseif ($role == 'Enterprise') {
                return to_route('profile.enterprise');
            } else {
                return view('welecome');
            }
        }
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $offer = Offer::where('title', 'like', '%' . $search . '%')
            ->orWhere('skills', 'like', '%' . $search . '%')
            ->orWhere('contract', 'like', '%' . $search . '%')
            ->orWhere('location', 'like', '%' . $search . '%')
            ->get();
        if ($offer->isNotEmpty()) {
            return view('searchResult', ['offer' => $offer]);
        } else {
            return view('searchResult')->with('fail', 'No offers were found');
        }
    }
}
