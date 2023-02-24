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
            'name' => 'required|min:3|max:128'
        ]);

        $isExist = TypeOfClient::where('name', '=', $request->city)->first();
        if ($isExist === null) {
            $typeOfClients = new TypeOfClient();
            $typeOfClients->name = $request->input('name');
            $typeOfClients->save();
        } else {
            return back()->withInput()->withErrors(['name' => 'Такой тип клиентов уже существует']);

        }

        return redirect()->route('type_of_clients.index');
    }

    public function edit(TypeOfClient $typeOfClient) {
        return view('offices.type_of_clients.edit')->with([
            'typeOfClient'  => $typeOfClient
        ]);
    }

    public function update(Request $request, TypeOfClient $typeOfClient) {
        $this->validate($request,[
            'name' => 'required|min:3|max:128'
        ]);

        $typeOfClient->update(['name' => $request->name]);

        return redirect()->route('type_of_clients.index');
    }

    public function delete() {

    }
}
