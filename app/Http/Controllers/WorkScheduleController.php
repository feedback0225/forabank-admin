<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\TypeOfClient;
use App\Models\WorkSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkScheduleController extends Controller
{
    public function index() {
        $workSchedules = WorkSchedule::with('typeOfClient', 'office')->paginate(15);
        return view('offices.work_schedules.index', compact('workSchedules'));
    }

    public function create() {
        $typeOfClients = TypeOfClient::all();
        $offices = Office::all();
        return view('offices.work_schedules.add', compact('typeOfClients', 'offices'));
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

    public function edit(WorkSchedule $workSchedule) {
        $typeOfClients = TypeOfClient::all();
        $offices = Office::all();
        return view('offices.work_schedules.edit', compact('typeOfClients', 'workSchedule', 'offices'));
    }

    public function update(Request $request, WorkSchedule $workSchedule) {
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

    public function delete(WorkSchedule $workSchedule) {
        DB::beginTransaction();
        try {
            WorkSchedule::whereId($workSchedule->id)->delete();

            DB::commit();
            return redirect()->route('work_schedules.index')->with('success', 'График Работы успешно удален');

        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
