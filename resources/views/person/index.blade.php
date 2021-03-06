@extends('layouts.app')

@section('content')
<div class="container">
  <div class="justify-content-center">
      <div class="card">
        <div class="card-header d-flex justify-content-between align-middle">
            <h5 class="pt-1 pl-4">            
              Datos personales
              @if($user->user_type == '1') del contacto @endif
            </h5>
            <button class="btn btn-primary btn-sm" onClick="document.title='{{$user->name}} {{$user->surname}}'; window.print();">
              <i class="far fa-file-pdf fa-xl mr-2"></i> 
              <span>Descargar</span>
            </button>
        </div>
        <div class="card-body p-5">
          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif

          <form action="{{url('users', [$user->id])}}" method="POST" enctype="multipart/form-data">
            {{method_field('PATCH')}}
            @csrf
            <div class="row">
              <div class="col-md-3">
                @if($user->profile_photo === "")
                  <i class="fas fa-portrait fa-10x"></i>
                @else
                  <img src="{{'/avatars/'.$user->profile_photo}}" width="150"/>
                @endif
              </div>
              <div class="col-md-9">
                <div class="form-group row">
                  <div class="col-md-3 align-middle">
                  </div>
                  @if (disabledInput($user->id, Auth::user()->id))
                  <div class="col-md-6 align-middle d-print-none">
                    <input type="file" class="custom-file-input" id="file" name="file">
                    <label class="custom-file-label mx-3" for="customFile">Elegir foto</label>
                  </div>
                  @endif
                </div>
                <div class="form-group row">
                  <label for="name" class="col-md-3 col-form-label text-md-left">
                    @if($user->user_type == '1')
                      Razón social
                    @else
                      Nombre
                    @endif
                  </label>

                  <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}" {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}>

                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="surname" class="col-md-3 col-form-label text-md-left">
                    @if($user->user_type == '1')
                      Nombre de fantasía
                    @else
                      Apellidos
                    @endif
                  
                  </label>

                  <div class="col-md-6">
                    <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{$user->surname}}" {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}>

                    @error('surname')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                @if($user->user_type === '1')
                  <div class="form-group row">
                    <label for="company_name" class="col-md-3 col-form-label text-md-left">Giro</label>

                    <div class="col-md-6">
                      <input id="company_name" type="text" class="form-control @error('company_name') is-invalid @enderror" name="company_name" value="{{$user->company_name}}" {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}">

                      @error('company_name')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>
                @endif

                <div class="form-group row">
                  <label for="email" class="col-md-3 col-form-label text-md-left">Email</label>

                  <div class="col-md-6">
                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="telephone" class="col-md-3 col-form-label text-md-left">Teléfono</label>

                  <div class="col-md-6">
                    <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{$user->telephone}}" {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}>

                    @error('telephone')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                @if($user->user_type != '1')
                <div class="form-group row">
                  <label for="document_id" class="col-md-3 col-form-label text-md-left">RUT</label>

                  <div class="col-md-6">
                    <input id="document_id" type="text" class="form-control @error('document_id') is-invalid @enderror" name="document_id" value="{{$user->document_id}}" {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}>

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
                    <input
                      id="birthday"
                      type="date"
                      class="date form-control @error('birthday') is-invalid @enderror"
                      name="birthday"
                      value="{{$user->birthday}}"
                      {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}
                      placeholder="dd-mm-aaaa"
                    >

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
                  <select id="gender" name="gender" class="form-control" {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}>
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
                @endif

                <div class="form-group row">
                  <label for="region" class="col-md-3 col-form-label text-md-left">Región</label>

                  <div class="col-md-6">
                  <select
                    id="region"
                    name="region"
                    class="form-control"
                    {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}
                  >
                    <option value="-" {{($user->region == "") ? "selected":""}}>Por favor seleccione una región</option>
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

                <div class="form-group row">
                  <label for="city" class="col-md-3 col-form-label text-md-left">Comuna</label>

                  <div class="col-md-6">
                  <select id="city" name="city" class="form-control" {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}>
                    @if($user->city !== "")
                      @foreach(cityList($user->region) as $key => $city)
                        <option value={{$city['code']}} {{ ($user->city == $city['code'] ? "selected":"") }}>{{$city['name']}}</option>
                      @endforeach
                    @endif
                  </select>
                    @error('city')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                @if($user->user_type !== 1)
                <div class="form-group row">
                  <h5 class="col-md-12 text-md-left">Experiencias</h5>
                  @foreach($experience as $key => $exp)
                    <div class="col-md-6" key="{{$key}}">
                      <label class="col-form-label text-md-left col-md-6">{{$exp->description}}</label>
                      <label for="">
                        <input
                          type="radio"
                          name="experience-list-{{$exp->experience_id}}[]"
                          id="experience-list-{{$exp->experience_id}}-1"
                          class="mr-2"
                          value="{{$exp->experience_id}}-1"
                          {{checkedInput($exp->experience_id.'-1', $user->experiences)}}
                          {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}
                        >1
                      </label>
                      <label for="">
                        <input
                          type="radio"
                          name="experience-list-{{$exp->experience_id}}[]"
                          id="experience-list-{{$exp->experience_id}}-2"
                          class="mr-2"
                          value="{{$exp->experience_id}}-2"
                          {{checkedInput($exp->experience_id.'-2', $user->experiences)}}
                          {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}
                        >2
                      </label>
                      <label for="">
                        <input
                          type="radio"
                          name="experience-list-{{$exp->experience_id}}[]"
                          id="experience-list-{{$exp->experience_id}}-3"
                          class="mr-2"
                          value="{{$exp->experience_id}}-3"
                          {{checkedInput($exp->experience_id.'-3', $user->experiences)}}
                          {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}
                        >3
                      </label>
                      <label for="">
                        <input
                          type="radio"
                          name="experience-list-{{$exp->experience_id}}[]"
                          id="experience-list-{{$exp->experience_id}}-4"
                          class="mr-2"
                          value="{{$exp->experience_id}}-4"
                          {{checkedInput($exp->experience_id.'-4', $user->experiences)}}
                          {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}
                        >4
                      </label>
                      <label for="">
                        <input
                          type="radio"
                          name="experience-list-{{$exp->experience_id}}[]"
                          id="experience-list-{{$exp->experience_id}}-5"
                          class="mr-2"
                          value="{{$exp->experience_id}}-5"
                          {{checkedInput($exp->experience_id.'-5', $user->experiences)}}
                          {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}
                        >5
                      </label>

                    </div>
                  @endforeach
                </div>
                @endif
                <div class="form-group row">
                  <h5 class="col-md-12 text-md-left">Tipo restaurante</h5>
                  @foreach($resto_type as $key => $resto)
                    <div class="col-md-4" key="{{$key}}">
                      <label class="col-form-label text-md-left">
                        <input type="checkbox" class="mr-2"
                          name="resto-type-id[]"
                          id="resto-type-id-{{$resto->resto_type_id}}"
                          value="{{$resto->resto_type_id}}"
                          {{checkedInput($resto->resto_type_id, $user->resto_type)}}
                          {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}
                        >
                        {{$resto->description}}
                      </label>
                    </div>
                  @endforeach
                  <div class="col-md-8 row" key="{{$key}}">
                    <label class="col-sm-3 col-form-label text-md-left mr-0">
                      <input type="checkbox" name="resto-type-id-other" id="-" class="mr-2"
                      {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}>
                      Otro
                    </label>
                    <input type="text" name="resto_type_other" id="resto_type_other" class="form-control col-sm-9"
                    {{(disabledInput($user->id, Auth::user()->id) ? "": "disabled")}}>
                  </div>
                </div>

                @if($user->user_type === '1')
                <div class="form-group row">
                  <label class="col-md-12 col-form-label text-md-left">Horario atención</label>
                </div>
                @endif

              </div>
            </div>
            <div class="text-center">
              @if(disabledInput($user->id, Auth::user()->id))
                <button class="btn btn-primary d-print-none" type="submit">Actualizar</button>
              @else
                <button class="btn btn-success d-print-none" onClick="window.close();">Cerrar</button>
              @endif
            </div>
          </form>
        </div>
      </div>
  </div>
</div>

@endsection
@yield('scripts')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $('#region').change(function(){
        var inputValue = $(this).val();
        getCityList(inputValue);
    });
    $('#birthday').change(function(){
        var inputValue = $(this).val();
        var birthday = new Date(inputValue);
        var today = new Date();
        if(today < birthday){
          var dd = String(today.getDate()).padStart(2, '0');
          var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
          var yyyy = today.getFullYear();
          today = yyyy + '-' + mm + '-' + dd;          
          $(this).val(today);
        }
    });
  });

</script>
