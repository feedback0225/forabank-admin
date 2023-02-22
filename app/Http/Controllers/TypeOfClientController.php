<?php

namespace App\Http\Controllers;

use App\Models\TypeOfClient;
use Illuminate\Http\Request;

class TypeOfClientController extends Controller
{
    public function index() {
        $typeOfClients = TypeOfClient::paginate(15);
        return view('offices.type_of_clients.index', compact('typeOfClients'));
    }

    public function create() {
        return view('offices.type_of_clients.add');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'name'=>'required|min:3|max:128'
        ]);

        $isExist = TypeOfClient::where('name', '=', $request->city)->first();
        if ($isExist === null) {
            $city = new TypeOfClient();
            $city->city = $request->input('city');
            $city->save();
        } else {
            return back()->withInput()->withErrors(['city' => 'Такой город уже существует']);

        }

        return redirect()->route('cities.index');
    }

    public function edit(City $city) {
        return view('offices.cities.edit')->with([
            'city'  => $city
        ]);
    }

    public function update(Request $request, City $city) {
        $this->validate($request,[
            'city'=>'required|min:3|max:128'
        ]);

        $city->update(['city' => $request->city]);

        return redirect()->route('cities.index');
    }

    public function delete() {

    }
}
