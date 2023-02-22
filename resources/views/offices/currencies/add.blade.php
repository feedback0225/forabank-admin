@extends('layouts.app')

@section('title', 'Добавить Валюту')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Добавить Валюту</h1>
        <a href="{{route('currencies.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Добавить Валюту</h6>
        </div>
        <form method="POST" action="{{route('currencies.store')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- Валюта --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="type"><span style="color:red;">*</span>Название Валюты</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('type') is-invalid @enderror"
                            id="exampleType"
                            placeholder="Валюта"
                            name="type"
                            value="{{ old('type') }}">

                        @error('type')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Сохранить</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('currencies.index') }}">Отменить</a>
            </div>
        </form>
    </div>

</div>


@endsection
