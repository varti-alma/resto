@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Usuario</div>
        <div class="card-body">
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif

          <form action="{{url('users', [$user->id])}}" method="POST">
            {{method_field('PATCH')}}
            @csrf
            <div class="form-group row">
              <label for="name" class="col-md-3 col-form-label text-md-left">Nombre</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">

                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="surname" class="col-md-3 col-form-label text-md-left">Apellidos</label>

              <div class="col-md-6">
                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{$user->surname}}">

                @error('surname')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-3 col-form-label text-md-left">Email</label>

              <div class="col-md-6">
                <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" disabled>
              </div>
            </div>

            <div class="form-group row">
              <label for="telephone" class="col-md-3 col-form-label text-md-left">Teléfono</label>

              <div class="col-md-6">
                <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{$user->telephone}}">

                @error('telephone')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="document_id" class="col-md-3 col-form-label text-md-left">RUT</label>

              <div class="col-md-6">
                <input id="document_id" type="text" class="form-control @error('document_id') is-invalid @enderror" name="document_id" value="{{$user->document_id}}">

                @error('document_id')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="birthday" class="col-md-3 col-form-label text-md-left">Fecha de nacimiento</label>

              <div class="col-md-6">
                <input id="birthday" type="text" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{$user->birthday}}">

                @error('birthday')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="gender" class="col-md-3 col-form-label text-md-left">Género</label>

              <div class="col-md-6">
              <select id="gender" name="gender" class="form-control">
                <option value="1" {{ ($user->gender == "1" ? "selected":"") }}>Hombre</option>
                <option value="0" {{ ($user->gender == "0" ? "selected":"") }}>Mujer</option>
                <option value="" {{ ($user->gender != "1" && $user->gender != "0" ? "selected":"") }}>No responde</option>
              </select>
                @error('gender')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <div class="form-group row">
              <label for="region" class="col-md-3 col-form-label text-md-left">Región</label>

              <div class="col-md-6">
              <select id="region" name="region" class="form-control">
                @foreach(regionList() as $key => $region)
                  <option value={{$key}} {{ ($user->region == $key ? "selected":"") }}>{{$region}}</option>
                @endforeach
              </select>
                @error('region')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                @enderror
              </div>
            </div>
            <button class="btn btn-primary" type="submit">Actualizar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
