<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Currency;
use App\Models\Office;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
    public function index() {
        $offices = Office::with('city')->paginate(15);

        return view('offices.offices.index', ['offices' => $offices]);
    }

    public function create() {
        $cities = City::all();
        $currencies = Currency::all();
        return view('offices.offices.add', compact('cities', 'currencies'));
    }

    public function store(Request $request) {
        $this->validate($request,[
            'city_id' => 'exists:cities,id',
            'name' => 'required|min:3|max:512',
            'lat' => 'required|min:3|max:512',
            'lng' => 'required|min:3|max:512',
            'address' => 'required|min:3|max:512',
            'currencies'  => 'required|array|min:1',
            'phone' => 'required|numeric',
            'email' => 'required|min:3|max:128',
            'is_active' => 'required|numeric|min:0|max:1'
        ]);

        $city = City::where(['id' => $request->city_id])->firstOrFail();

        $office = new Office();
        $office->city()->associate($city);
        $office->name = $request->name;
        $office->lat = $request->lat;
        $office->lng = $request->lng;
        $office->address = $request->address;
        $office->phone = $request->phone;
        $office->email = $request->email;
        $office->is_active = $request->is_active;
        $office->save();

        $office->currencies()->attach($request->currencies);

        return redirect()->route('offices.index');
    }

    public function edit($office_id) {
        $office = Office::where('id', $office_id)->with('currencies')->firstOrFail();
        $currencies = Currency::all();
        $cities = City::all();

        return view('offices.offices.edit', compact('office', 'currencies', 'cities'));
    }

    public function update(Request $request, Office $office) {
        $this->validate($request,[
            'city_id' => 'exists:cities,id',
            'name' => 'required|min:3|max:512',
            'lat' => 'required|min:3|max:512',
            'lng' => 'required|min:3|max:512',
            'address' => 'required|min:3|max:512',
            'currencies'  => 'required|array|min:1',
            'phone' => 'required|numeric',
            'email' => 'required|min:3|max:128',
            'is_active' => 'required|numeric|min:0|max:1'
        ]);


        $city = City::where(['id' => $request->city_id])->firstOrFail();

        $office->city()->associate($city);
        $office->name = $request->name;
        $office->lat = $request->lat;
        $office->lng = $request->lng;
        $office->address = $request->address;
        $office->phone = $request->phone;
        $office->email = $request->email;
        $office->is_active = $request->is_active;
        $office->save();

        $office->currencies()->attach($request->currencies);

        return redirect()->route('offices.index');
    }

    public function importOffices() {

    }

    public function delete(Office $office) {
        DB::beginTransaction();
        try {
            Office::whereId($office->id)->delete();

            DB::commit();
            return redirect()->route('offices.index')->with('success', 'Офис успешно удален');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
