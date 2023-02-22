@extends('layouts.app')

@section('title', '???????? ?????')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">???????? ?????</h1>
        <a href="{{route('cities.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> ?????</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">???????? ?????</h6>
        </div>
        <form method="POST" action="{{route('cities.update', ['city' => $city->id])}}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group row">

                    {{-- ????? --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="name"><span style="color:red;">*</span>???????????? ??????</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('city') is-invalid @enderror"
                            id="exampleCity"
                            placeholder="?????"
                            name="city"
                            value="{{ old('city') ?  old('city') : $city->city}}">

                        @error('city')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">?????????</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('cities.index') }}">??????</a>
            </div>
        </form>
    </div>

</div>


@endsection
