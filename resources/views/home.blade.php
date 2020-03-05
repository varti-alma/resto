@extends('layouts.app')

@section('content')
<div class="container">
  @if($userLogged->user_type == '1')
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">Filtros</div>
          <div class="card-body">
            <select name="selected_region" id="selected_region_list" class="form-control">
            @foreach(regionList() as $key => $region)
              <option value={{$key}}>{{$region}}</option>
            @endforeach
            </select>
            <select id="city" name="city" class="form-control mt-3">
              @foreach(cityList('I') as $key => $city)
                <option value={{$key}}>{{$city}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        @if(count($userList) > 0)
          <div class="row ml-2">
            <div class="col-1">
              <input type="checkbox" name="user-selected" id="user-selected-all">
            </div>
            <div class="col-11 text-right pr-3">
              <button class="btn btn-primary btn-sm"><i class="fas fa-envelope fa-xl mr-2"></i> Enviar por correo</button>
            </div>
          </div>
          @foreach($userList as $key => $user)
            <div class="row user-row">
              <div class="col-1 text-center">
                <input type="checkbox" name="user-selected" id="user-selected-{{$key}}">
              </div>
              <div class="row col-12 col-md-9 pl-0">
                <div class="col-12"> {{($user->name != "" ? $user->name.' '.$user->surname : "Sin nombre" )}}
                  <label for="" class="label-place {{($user->city == "" ? 'bg-grey': '')}}">
                    <i class="fas fa-map-marker-alt fa-md mr-1"></i>
                    {{($user->city != "" ? getCityName($user->city) : "Sin ciudad" )}}, {{($user->region != "" ? getRegionName($user->region) : "Sin región" )}}
                  </label>
                  <label for="" class="label-gender {{getGenderLabelColor($user->gender)}}">{{getGender($user->gender)}}
                </div>
                <div class="col-12 col-md-6"><i class="fas fa-envelope fa-md text-secondary"></i> {{$user->email}}</div>
                <div class="col-12 col-md-6"><i class="fas fa-phone-alt fa-md text-secondary"></i> {{($user->telephone != "" ? $user->telephone : "Sin teléfono" )}}</div>
                <div class="col-12 my-2"><i class="fas fa-utensils fa-md mr-2 text-secondary"></i>{{$user->resto_type}}</div>
              </div>
              <div class="col-12 col-md-2">
                <a href="/users/{{$user->id }}" class="btn btn-primary">Ver</a>
              </div>
            </div>
          @endforeach
        @else
          <h4 class="text-center">No hay usuarios registrados</h4>
        @endif
      </div>
    </div>
  @else
    <h3>Bienvenido a la aplicación</h3>
  @endif
</div>
@endsection
