<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index() {
        $cities = City::paginate(15);
        return view('offices.cities.index', compact('cities'));
    }

    public function create() {
        return view('offices.cities.add');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'city'=>'required|min:3|max:128'
        ]);

        $isExist = City::where('city', '=', $request->city)->first();
        if ($isExist === null) {
            $city = new City();
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
