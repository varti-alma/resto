@extends('layouts.app')

@section('content')
<div class="container">
  @if($userLogged->user_type == '1')
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <form action="{{url('filterPeopleList')}}" method="POST">
            {{method_field('PATCH')}}
            @csrf
            <input type="hidden" name="photo" value="false" />
            <div class="card-header d-flex justify-content-between align-middle">
              Filtros
              <button id="clean-all" class="btn btn-primary btn-sm">
                <i class="fas fa-recycle fa-xl mr-2"></i> 
                <span>Limpiar</span>
              </button>
            </div>
            <div class="card-body">
              <label for="selected_region_list" class="mb-0">Región</label>
              <select name="selected_region" id="selected_region_list" class="form-control">
                <option value="-">Todos</option>
              @foreach(regionList() as $key => $region)
                <option value={{$key}}
                  {{($param['selected_region'] == $key ? 'selected' : '' )}}
                >{{$region}}</option>
              @endforeach
              </select>
              <label for="city" class="mt-3 mb-0">Ciudad</label>
              <select id="city" name="city" class="form-control mb-3">
              </select>
              <div class="form-inline">
                <div class="form-group">
                  <label for="txtSearchExperience" class="mb-3">Experiencias</label>
                  <!--
                  <input
                    type="text"
                    class="form-control"
                    id="txtSearchExperience"
                    name="txtSearchExperience"
                    data-role="tagsinput"
                    placeholder="Buscar"
                    onKeyDown="return searchList(event, 'experience-list');"
                  >
                  -->
                </div>
              </div>
              <div id="experience-list">
              @foreach($experienceList as $key => $experience)
                <div class={{'experience-div-'.$experience->experience_id}} key={{$key}}>
                  <input
                    type="checkbox"
                    class="experience-selected"
                    id="experience-selected-{{$experience->experience_id}}"
                    name="experience-selected-id[]"
                    value="{{$experience->experience_id}}"
                    {{checkedInputArrayHome($experience->experience_id, $param, 'experience-selected-id')}}
                  >
                  <label for="experience-selected-{{$experience->experience_id}}" class="pl-4">{{$experience->description}}</label>
                </div>
              @endforeach
              </div>
              <div class="form-inline">
                <div class="form-group">
                  <label for="txtSearchResto" class="mr-3 mb-3">Restaurantes</label>
                  <!--
                  <input
                    type="text"
                    class="form-control"
                    id="txtSearchResto"
                    name="txtSearchResto"
                    data-role="tagsinput"
                    placeholder="Buscar"
                    onKeyDown="return searchList(event, 'txtSearchResto');"
                  >
                  -->
                </div>
              </div>
              <div id="resto-list">
              @foreach($restoTypeList as $key => $resto)
                <div class="resto-div" key={{$key}}>
                  <input
                    type="checkbox"
                    class="resto-selected"
                    id="resto-selected-{{$resto->resto_type_id}}"
                    name="resto-selected-id[]"
                    value="{{$resto->resto_type_id}}"
                    {{checkedInputArrayHome($resto->resto_type_id, $param, 'resto-selected-id')}}
                  >
                  <label for="resto-selected-{{$resto->resto_type_id}}" class="pl-4">{{$resto->description}}</label>
                </div>
              @endforeach
              </div>
              <!--
              <label for="txtSkills">Filtros</label>
              <input
                type="text"
                class="form-control"
                id="txtSkills"
                name="Skills"
                data-role="tagsinput"
                onKeyDown="return tab_btn(event);"
              >
              <div id="filter-list" class="mt-3"></div>
              -->
            </div>
          </form>
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
            <div class="col-6">
              <input type="checkbox" name="user-selected-all" id="user-selected-all">
              <label for="user-selected-all" class="pl-4">Seleccionar todos</label>
            </div>
            <div class="col-6 text-right pr-3">
              <button id="download-file" class="btn btn-primary btn-sm">
                <i class="far fa-file-excel fa-xl mr-2"></i> <span>Exportar</span>
              </button>
            </div>
          </div>
          <div id="user-list">
          @foreach($userList as $key => $user)
            <div class="row user-row">
              <div class="col-1 text-center">
                <input type="checkbox" class="user-selected" name="user-selected[]" id="user-selected-{{$user->id}}" value="{{$user->id}}">
              </div>
              <div class="row col-11 col-md-9 pl-0">
                <div class="col-3 pr-0">
                  @if($user->profile_photo != "")
                    <img src="{{'/avatars/'.$user->profile_photo}}" class="img-fluid"/>
                  @else
                    <i class="fas fa-portrait fa-9x"></i>
                  @endif
                </div>
                <div class="col-9"> 
                  <div class="col-12">
                    <p class="mb-1">
                      {{($user->name != "" ? $user->name.' '.$user->surname : "Sin nombre" )}}</span>
                      <span class="label-gender {{getGenderLabelColor($user->gender)}}">{{getGender($user->gender)}}
                    </p>
                    <label for="" class="label-place {{($user->city == "" ? 'bg-grey': '')}}">
                      <i class="fas fa-map-marker-alt fa-md mr-1"></i>
                      {{($user->city != "-" && $user->city != "" ? getCityName($user->city, $user->region) : "Sin ciudad" )}}, {{($user->region != "" ? getCityListName($user->region) : "Sin región" )}}
                    </label>
                  </div>
                  <div class="col-12"><i class="fas fa-envelope fa-md text-secondary"></i> {{$user->email}}</div>
                  <div class="col-12"><i class="fas fa-phone-alt fa-md text-secondary"></i> {{($user->telephone != "" ? $user->telephone : "Sin teléfono" )}}</div>
                  <div class="col-12"><i class="fas fa-store fa-md mr-2 text-secondary"></i>{{$user->resto_type}}</div>
                  <div class="col-12"><i class="fas fa-utensils fa-md mr-2 text-secondary"></i>{{$user->experiences}}</div>
                </div>
              </div>
              <div class="col-12 col-md-2">
                <a href="/users/{{$user->id}}" class="btn btn-primary" target="_blank">Ver</a>
              </div>
            </div>
          @endforeach
          </div>
        @else
          <h4 class="text-center mt-5">No hay usuarios registrados con esas características</h4>
        @endif
      </div>
    </div>
  @else
    <h3>Bienvenido a la aplicación</h3>
  @endif
</div>
@endsection
@yield('scripts')

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>
<script>
  $(document).ready(function(){
    // Carga inicial de región 
    var inputValue = $('#selected_region_list').val();
    getCityList(inputValue, "{{$param['city']}}");

    $('#clean-all').click(function(){
      $("#selected_region_list").val("-");
      getCityList('-', '-');
      $(".experience-selected").prop("checked", false);
      $(".resto-selected").prop("checked", false);
      this.form.submit();
    });

    $('#download-file').click(function(){
      var CSRF_TOKEN = $("input[name=_token]").val();
      downloadFile( CSRF_TOKEN );
    });

    $('#user-selected-all').change(function(){
      if($('#user-selected-all').prop('checked')){
        $(".user-selected").prop("checked", true);
      }else{
        $(".user-selected").prop("checked", false);
      }
    });
    $('#selected_region_list').change(function(){
        var inputValue = $(this).val();
        getCityList(inputValue, "{{$param['city']}}");
        this.form.submit();
    });
    $('#city').change(function(){
      this.form.submit();
    });
    $('.experience-selected').change(function(){
      this.form.submit();
    });
    $('.resto-selected').change(function(){
      this.form.submit();
    });
  });
  $(document).on('click', '.label-filter', function(e) {
    $("#"+this.id).remove();
  });
</script>

