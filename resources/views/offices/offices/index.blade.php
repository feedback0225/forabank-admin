@extends('layouts.app')

@section('title', 'Оффисы и банкоматы')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Офисы</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('offices.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Добавить
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('offices.import') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-check"></i> Импорт из exc
                    </a>
                </div>

            </div>

        </div>

        {{-- Alert Messages --}}
        @include('common.alert')

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Список</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="10%">Город</th>
                                <th width="15%">Название</th>
                                <th width="12%">Адрес</th>
                                <th width="10%">Ширина</th>
                                <th width="10%">Долгота</th>
                                <th width="4%">Активный</th>
                                <th width="8%">Номер</th>
                                <th width="8%">Email</th>
                                <th width="10%">Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($offices as $office)
                                <tr>
                                    <td>{{ $office->city->city }}</td>
                                    <td>{{ $office->name }}</td>
                                    <td>{{ $office->address }}</td>
                                    <td>{{ $office->lat }}</td>
                                    <td>{{ $office->lng }}</td>
                                    <td>
                                        @if ($office->is_active == 0)
                                            <span class="badge badge-danger">Inactive</span>
                                        @elseif ($office->is_active == 1)
                                            <span class="badge badge-success">Active</span>
                                        @endif
                                    </td>
                                    <td>{{ $office->phone }}</td>
                                    <td>{{ $office->email }}</td>

                                    <td style="display: flex">
                                        <a href="{{ route('offices.edit', ['office' => $office->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <form id="user-delete-form" method="POST" action="{{ route('offices.destroy', ['office' => $office->id]) }}">
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

                    {{ $offices->links() }}
                </div>
            </div>
        </div>

    </div>

{{--    @include('users.delete-modal')--}}

@endsection

@section('scripts')

@endsection
