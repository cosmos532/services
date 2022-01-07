<?php

namespace App\Http\Controllers;

use Mail;
use Redirect;
use DateTime;
use App\Models\User;
use App\Models\Service;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        //
    }

    public function create($service)
    {
        $id = auth()->id();
        $user = User::find($id);

        if($user->status == 'INACTIVE')
        {
            return view('users.inactive');
        }  

        if($user->user_type == 'Super')
        {
            //
        }

        if($user->user_type == 'User')
        {
           $user->assignRole('User'); 
        }

        if($user->user_type == 'Admin')
        {
           return view('home'); 
        }
        
        $selected_service = Service::find($service);
        $services = Service::all();

        return view('bookings.create', compact('user', 'selected_service', 'services', )); 
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function status(Request $request)
    {
        //
    }

    public function select()
    {
        $services = Service::all();

        if (!$services->isEmpty()) {

            foreach ($services as $service) {
                if($service->type == 1)
                {
                  $elements[] = array('value'=>$service->id,'description'=>$service->description, 'type'=>$service->type);  
                }
            }

            return $json = json_encode($elements);
        }
    }

    public function checkDate(Request $request)
    {
        //
    }

    public function prices()
    {
        $services = Service::all();

        if (!$services->isEmpty()) {

            foreach ($services as $service) {
                $elements[] = array($service->price);  
            }

            $prices = json_encode($elements);
        }

        return $prices;
    }
}
