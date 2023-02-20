<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Currency;
use App\Models\Office;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index() {
        $offices = Office::with('city')->paginate(15);
        return view('offices.offices.index', ['offices' => $offices]);
    }

    public function create() {
        $cities = City::all();
        $currencies = Currency::all();
        $work_schedules = WorkSchedule::with('typeOfClient');
        return view('offices.offices.add', [
            'cities' => $cities,
            'currencies' => $currencies,
            'work_schedules' => $work_schedules
        ]);
    }

    public function store() {

    }

    public function importOffices() {

    }

    public function edit() {

    }

    public function update() {

    }

    public function delete() {

    }
}
