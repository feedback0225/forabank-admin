@extends('layouts.app')

@section('title', 'Добавить Страницу')

@section('content')

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Добавить Страницу</h1>
            <a href="{{route('landings.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
        </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Добавить Страницу</h6>
            </div>
            {{--Конструктор Страниц--}}
            <page-builder :blocks="{{ json_encode($blocks) }}"/>

        </div>

    </div>


@endsection
