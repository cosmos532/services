<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = auth()->id();
        $user = User::find($id);

        if ($user->user_type == 'Super')
        {   
            $user->assignRole('Super');

            $users = User::all();
            $bookings = Booking::all();
            return view ('home', compact('users','bookings'));
        }

        if ($user->user_type == 'Admin')
        {   
            $user->assignRole('Admin');

            $users = User::all();
            $bookings = Booking::all();
            return view ('home', compact('users', 'bookings'));
        }

        if ($user->user_type == 'User' && $user->status == 'ACTIVE')
        {   
            $user->assignRole('User');
            return view('home');
        }

        if($user->status == 'INACTIVE')
        {
            return view('users.inactive');
        }
    }
}
