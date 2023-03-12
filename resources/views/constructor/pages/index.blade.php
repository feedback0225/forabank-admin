@extends('layouts.app')

@section('title', 'Landing страницы')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Landing страницы</h1>
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('landings.create') }}" class="btn btn-sm btn-primary">
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
                <h6 class="m-0 font-weight-bold text-primary">Список</h6>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="50%">Имя страницы</th>
                            <th width="10%">Действия</th>

                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($landings as $landing)
                            <tr>
                                <td>{{ $landing->component }}</td>
                                <td style="display: flex">
                                    <a href="{{ route('landings.edit', ['landing' => $landing->id]) }}"
                                       class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {{ $landings->links() }}
                </div>
            </div>
        </div>

    </div>

    {{--    @include('users.delete-modal')--}}

@endsection

@section('scripts')

@endsection
