<?php

namespace App\Http\Controllers;

use App\Models\Anime;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class ControlPanel extends Controller
{
    // Showing login page for control panel
    public function login() {
        return view('controlPanel.login');
    }

    // Showing home page for control panel
    public function home() {
        return view('controlPanel.home');
    }

    // Showing animes page for control page
    public function animes() {
        return view('controlPanel.animes');
    }

    // Showing new anime page for control page
    public function newAnime() {
        return view('controlPanel.newAnime');
    }

    // Showing anime edit page for control page
    public function editAnime() {
        return view('controlPanel.editAnime');
    }

    // Authenticating a new administrator
    public function authenticate(Request $request) {
        $secureInfo = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($secureInfo, $request['remember'])){
            $request->session()->regenerate();
            return redirect('/controlpanel/home')->with('message', 'You are logged in!');
        };

        return back()->withErrors(['email' => 'Some informations are wrong :('])->onlyInput('email');
    }

    // Logging a user out
    public function logout(Request $request) {
        auth()->logout();
        $request->session()->invalidate();

        return redirect('/controlpanel');
    }

    // Storing a new anime
    public function animeStore(Request $request) {
        $secureInfo = $request->validate([
            'name' => ['required', 'max:255', 'min:3'],
            'description' => ['required'],
            'animeCover' => ['required'],
            'animeBackground' => ['required']
        ]);

        $secureInfo['animeCover'] = $request->file('animeCover')->store('animeCovers', 'public');
        $secureInfo['animeBackground'] = $request->file('animeBackground')->store('animeBackgrounds', 'public');

        Anime::create($secureInfo);
        return 'Everything is right!, now go GYM';

        // return $request;
    }
}
