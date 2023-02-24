@extends('layouts.app')

@section('title', 'Графики работ офисов')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Графики работ офисов</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('work_schedules.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Добавить
                    </a>
                </div>
            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Графики работ офисов</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="25%">Тип клиента</th>
                                <th width="35%">График работы офиса</th>
                                <th width="25%">Офис</th>
                                <th width="10%">Действия</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($workSchedules as $workSchedule)
                                <tr>
                                    <td>{{ $workSchedule->typeOfClient->name ?? 'N/A' }}</td>
                                    <td>{{ $workSchedule->schedule }}</td>
                                    <td>{{ $workSchedule->office->name ?? 'N/A' }}</td>
                                    <td style="display: flex">
                                        <a href="{{ route('work_schedules.edit', ['workSchedule' => $workSchedule->id]) }}"
                                           class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <form id="user-delete-form" method="POST" action="{{ route('work_schedules.destroy', ['workSchedule' => $workSchedule->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger m-2" >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $workSchedules->links() }}
                </div>
            </div>
        </div>

    </div>

    {{-- @include('offices.work_schedules.delete-modal') --}}

@endsection

@section('scripts')

@endsection
