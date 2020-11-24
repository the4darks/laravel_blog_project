<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Post;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index','update']);

    }
    public function index()
    {
        $user = Auth::user();
        $id = Auth::id();
        if ($user->profile == null) {
            Profile::create([
                'city' => 'Riyadh',
                'user_id' => $id,
                'gender' => 'Male',
                'bio' => 'My name is ' . $user->name,
                'twitter' => '@',
            ]);
        }
        return view('users.profile', compact('user'));
    }

    public function show($username)
    {
        $users = User::where('name', $username)->get();


         return view('users.show', compact('users'));
    }

    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'name' => 'required|string|min:5|max:10',
            'city' => 'required|string',
            'gender' => 'required',
            'bio' => 'required|string|min:5|max:50',

        ]);
        $user = Auth::user();
        $user->name = $request->name;
        $user->profile->city = $request->city;
        $user->profile->gender = $request->gender;
        $user->profile->bio = $request->bio;

        if ($request->has('password') || $request->has('twitter')) {
            $user->profile->twitter = $request->twitter;
            $user->password = Hash::make($request->password);
            $user->save();
            $user->profile->save();

        }
        return redirect()->back()->with('success', 'Profile updated Successfully');

    }

    
}
