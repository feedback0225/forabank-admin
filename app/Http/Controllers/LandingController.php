<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Landing;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() {
        $landings = Landing::paginate(15);

        return view('constructor.pages.index', ['landings' => $landings]);
    }

    public function create() {
        $blocks = Block::all();
        return view('constructor.pages.add', compact('blocks'));
    }

    public function store(Request $request) {
        $this->validate($request,[
            'type_of_client_id' => 'exists:type_of_clients,id',
            'schedule' => 'required|min:3|max:256',
            'office_id' => 'required|exists:offices,id'
        ]);

        $typeOfClient = TypeOfClient::where(['id' => $request->type_of_client_id])->firstOrFail();
        $office = Office::where(['id' => $request->office_id])->firstOrFail();

        $workSchedule = new WorkSchedule();
        $workSchedule->typeOfClient()->associate($typeOfClient);
        $workSchedule->office()->associate($office);
        $workSchedule->schedule = $request->schedule;
        $workSchedule->save();

        return redirect()->route('work_schedules.index');
    }

    public function createLandingAxios(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validate($request,[
            'title' => 'required|min:3|max:256',
            'path' => 'required|min:3|max:256|unique:landings'
        ]);

        $post = new Landing;
        $post->title = $request->title;
        $post->path = $request->path;
        $post->blocks = json_encode($request->blocks);
        $post->save();
        return response()->json([
            'message' => 'Landing страница успешно создана'
        ]);
    }
}
