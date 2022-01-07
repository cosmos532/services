<?php

namespace App\Http\Controllers;

use Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Super|Admin'))
        {   
            $users = User::where('user_type', '!=', 'Super')
                            ->orderBy('id', 'DESC')
                            ->paginate(25);
            return view('users.index', compact('users'));
        }
        else
        {
            return view('errors.403');
        }
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'user_type' => ['required', 'string', 'max:255'],
            'status' => ['required', 'string', 'max:255'],
        ]);

        User::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'address' => $request['address'],
            'city' => $request['city'],
            'zipcode' => $request['zipcode'],
            'password' => Hash::make($request['password']),
            'user_type' => $request['user_type'],
            'status' => $request['status'],
            'email_verified_at' => Carbon\Carbon::now()
        ]);

        if (Auth::user()->hasRole('Super|Admin'))
        {   
            $users = User::where('user_type', '!=', 'Super')
                            ->orderBy('id', 'DESC')
                            ->paginate(25);
            return view('users.index', compact('users'))->with('info', 'Usuario registrado con éxito.');
        }
        else
        {
            return view('errors.403');
        }
    }

    public function show($id)
    {
        $user = User::where('id', '=', $id)->first();

        return view('users.show', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->authorize('edit', $user);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'zipcode' => ['required', 'string', 'max:255'],
            'user_type' => ['required', 'string', 'max:255'],
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update', $user);

        if ($request['password'] != NULL)
        {
            $request['password'] = Hash::make($request->password);
            $user->password = $request['password'];
            $user->save();
        }

        $user->fill($request->except('password'))->save();

        return view('users.edit', compact('user'))->with('info', 'Usuario actualizado con éxito.');
    }

    public function destroy($id)
    {
        //
    }

    public function status(Request $request)
    {
        $user = User::find($request->id);
        $user->fill($request->all())->save();

        return redirect()->route('users.index')->with('info', 'Estado actualizado con éxito');
    }

    public function search(Request $request)
    {
        $users = User::where('user_type', '=', 'User')
                        ->orWhere('user_type', '=', 'Admin')
                        ->orderBy('id', 'DESC')
                        ->search($request)
                        ->paginate(50);
                            
        return view('users.index', compact('users'));
    }
}
