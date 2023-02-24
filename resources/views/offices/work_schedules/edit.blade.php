@extends('layouts.app')

@section('title', 'Изменить График Работы')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Изменить График Работы офиса</h1>
        <a href="{{route('work_schedules.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Изменить График</h6>
        </div>
        <form method="POST" action="{{route('work_schedules.update', ['workSchedule' => $workSchedule->id])}}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group row">




                    {{-- Тип клиента --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="type_of_client_id">Тип клиента</label>
                        <select class="form-control form-control-user @error('type_of_client_id') is-invalid @enderror" name="type_of_client_id">
                            <option selected disabled>Выберите Тип Клиента</option>
                            @foreach ($typeOfClients as $typeOfClient)
                                <option value="{{$typeOfClient->id}}"
                                    {{old('type_of_client_id') ? ((old('type_of_client_id') == $typeOfClient->id) ? 'selected' : '') : (($workSchedule->type_of_client_id == $typeOfClient->id) ? 'selected' : '')}}>
                                    {{$typeOfClient->name}}
                                </option>
                            @endforeach
                        </select>
                        @error('type_of_client_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- График --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="name"><span style="color:red;">*</span>График</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('schedule') is-invalid @enderror"
                            id="exampleSchedule"
                            placeholder="График"
                            name="schedule"
                            value="{{ old('schedule') ? old('schedule') : $workSchedule->schedule }}">

                        @error('schedule')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Офис --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="office_id">Офис</label>
                        <select class="form-control form-control-user @error('office_id') is-invalid @enderror" name="office_id">
                            <option selected disabled>Выберите Офис с таким графиком работы</option>
                            @foreach ($offices as $office)
                                <option value="{{$office->id}}"
                                    {{old('office_id') ? ((old('office_id') == $office->id) ? 'selected' : '') : (($workSchedule->office_id == $office->id) ? 'selected' : '')}}>
                                    {{$office->address}}
                                </option>
                            @endforeach
                        </select>
                        @error('office_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Сохранить</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('type_of_clients.index') }}">Назад</a>
            </div>
        </form>
    </div>

</div>


@endsection
