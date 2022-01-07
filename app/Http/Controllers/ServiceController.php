<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('Super|Admin'))
        {   
            $services = Service::where('status', 'REGISTERED')->orderBy('id', 'ASC')
                            ->paginate(25);
            return view('services.index', compact('services'));
        }
        else
        {
            return view('errors.403');
        }
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        if($request->price == null)
        {
            $price['price'] = 'wp';
            $request->merge($price);
        }

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255']
        ]);

        Service::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'price' => $request['price'],
            'type' => $request['type']
        ]);

        if (Auth::user()->hasRole('Super|Admin'))
        {   
            $services = Service::where('status', 'REGISTERED')->orderBy('id', 'ASC')
                            ->paginate(25);

            return view('services.index', compact('services'))->with('info', 'Servicio registrado con éxito.');
        }
        else
        {
            return view('errors.403');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        if($request->price == null)
        {
            $price['price'] = 'wp';
            $request->merge($price);
        }

        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'max:255']
        ]);

        $service = Service::findOrFail($id);

        $service->fill($request->all())->save();

        return view('services.edit', compact('service'))->with('info', 'Servicio actualizado con éxito.');
    }

    public function destroy($id)
    {
        $service = Service::find($request->id);
        $service->fill(['status' => 'DELETED'])->save();

        return redirect()->route('users.index')->with('info', 'Estado actualizado con éxito');
    }
}
