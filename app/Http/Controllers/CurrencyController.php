<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index() {
        $currencies = Currency::paginate(15);
        return view('offices.currencies.index', compact('currencies'));
    }

    public function create() {
        return view('offices.currencies.add');
    }

    public function store(Request $request) {
        $this->validate($request,[
            'type'=>'required|min:3|max:128'
        ]);

        $isExist = Currency::where('type', '=', $request->type)->first();
        if ($isExist === null) {
            $currency = new Currency();
            $currency->type = $request->input('type');
            $currency->save();
        } else {
            return back()->withInput()->withErrors(['type' => 'Такая валюта уже существует']);

        }

        return redirect()->route('currencies.index');
    }

    public function edit(Currency $currency) {
        return view('offices.currencies.edit')->with([
            'currency'  => $currency
        ]);
    }

    public function update(Request $request, Currency $currency) {
        $this->validate($request,[
            'type'=>'required|min:3|max:128'
        ]);

        $currency->update(['type' => $request->type]);

        return redirect()->route('currencies.index');
    }

    public function delete() {

    }
}
