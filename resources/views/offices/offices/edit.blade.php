@extends('layouts.app')

@section('title', 'Изменить данные офиса')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Изменить данные офиса</h1>
        <a href="{{route('offices.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Назад</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Изменить данные офиса</h6>
        </div>
        <form method="POST" action="{{route('offices.update', ['office' => $office->id])}}">
            @csrf
            @method('PUT')

            <div class="card-body">
                <div class="form-group row">

                    {{-- Город --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="city_id"><span style="color:red;">*</span>Город</label>
                        <select class="form-control form-control-user" @error('city_id') is-invalid @enderror name="city_id">
                            <option selected disabled>Выберите город</option>
                            @foreach ($cities as $city)
                                <option value="{{$city->id}}"
                                    {{old('city_id') ? ((old('city_id') == $city->id) ? 'selected' : '') : (($office->city_id == $city->id) ? 'selected' : '')}}
                                >
                                    {{$city->city}}</option>
                            @endforeach
                        </select>
                        @error('city_id')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Офис --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="name"><span style="color:red;">*</span>Название Пункта</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('name') is-invalid @enderror"
                            id="exampleName"
                            placeholder="Название пункта приема"
                            name="name"
                            value="{{ old('name') ? old('name') : $office->name }}">

                        @error('')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Широта --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="lat"><span style="color:red;">*</span>Широта</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('lat') is-invalid @enderror"
                            id="exampleLat"
                            placeholder="Широта"
                            name="lat"
                            value="{{ old('lat') ? old('lat') : $office->lat }}">

                        @error('lat')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Долгота --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="lng"><span style="color:red;">*</span>Долгота</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('lng') is-invalid @enderror"
                            id="exampleLng"
                            placeholder="Долгота"
                            name="lng"
                            value="{{ old('lng') ? old('lng') : $office->lng }}">

                        @error('lng')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Адрес --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="address"><span style="color:red;">*</span>Адрес</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('address') is-invalid @enderror"
                            id="exampleAddress"
                            placeholder="Адрес"
                            name="address"
                            value="{{ old('address') ? old('address') : $office->address }}">

                        @error('address')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Валюты --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="currencies">Валюты</label>
                        <select class="form-control form-control-user @error('currencies') is-invalid @enderror" name="currencies[]" multiple>
                            @foreach ($currencies as $currency)
                                <option value="{{$currency->id}}"
                                    {{ $office->currencies->contains('id', $currency->id) ? 'selected' : '' }}
                                >
                                    {{$currency->type}}
                                </option>
                            @endforeach
                        </select>
                        @error('currency')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    {{-- Номер телефона --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="phone">Номер телефона</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('phone') is-invalid @enderror"
                            id="examplePhone"
                            placeholder="Номер телефона"
                            name="phone"
                            value="{{ old('phone') ? old('phone') : $office->phone }}">

                        @error('phone')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="email">Email</label>
                        <input
                            type="text"
                            class="form-control form-control-user @error('email') is-invalid @enderror"
                            id="exampleEmail"
                            placeholder="Email"
                            name="email"
                            value="{{ old('email') ? old('email') : $office->email }}">

                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    {{-- Статус --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <label for="is_active">Статус</label>
                        <select class="form-control form-control-user @error('is_active') is-invalid @enderror" name="is_active">
                            <option selected disabled>Статус Работы</option>
                            <option value="1" {{old('is_active') ? ((old('is_active') == 1) ? 'selected' : '') : (($office->is_active == 1) ? 'selected' : '')}}>Активный</option>
                            <option value="0" {{old('is_active') ? ((old('is_active') == 0) ? 'selected' : '') : (($office->is_active == 0) ? 'selected' : '')}}>Не активный</option>

                        </select>
                        @error('is_active')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Сохранить</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('offices.index') }}">Отмена</a>
            </div>
        </form>
    </div>

</div>


@endsection
