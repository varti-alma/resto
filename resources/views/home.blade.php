@extends('layouts.app')

@section('content')
<div class="container">
  @if($userLogged->user_type == '1')
    <div class="row justify-content-center">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header">Filtros</div>
          <div class="card-body">
            <form action="{{url('filterPeopleList')}}" method="POST">
              {{method_field('PATCH')}}
              @csrf

            
            <select name="selected_region" id="selected_region_list" class="form-control">
            @foreach(regionList() as $key => $region)
              <option value={{$key}}
                {{($param['selected_region'] == $key ? 'selected' : '' )}}
              >{{$region}}</option>
            @endforeach
            </select>
            <select id="city" name="city" class="form-control my-3">
            </select>
            <div class="form-inline">
              <div class="form-group">
                <label for="txtSearchExperience" class="mr-3 mb-3">Experiencias</label>
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
                  id="resto-selected-{{$resto->id}}"
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
            </form>
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
            <div class="col-6">
              <input type="checkbox" name="user-selected-all" id="user-selected-all">
              <label for="user-selected-all" class="pl-4">Seleccionar todos</label>
            </div>
            <div class="col-6 text-right pr-3">
              <button class="btn btn-primary btn-sm"><i class="fas fa-envelope fa-xl mr-2"></i> Enviar por correo</button>
            </div>
          </div>
          <div id="user-list">
          @foreach($userList as $key => $user)
            <div class="row user-row">
              <div class="col-1 text-center">
                <input type="checkbox" name="user-selected" id="user-selected-{{$user->id}}">
              </div>
              <div class="row col-12 col-md-9 pl-0">
                <div class="col-12"> {{($user->name != "" ? $user->name.' '.$user->surname : "Sin nombre" )}}
                  <label for="" class="label-place {{($user->city == "" ? 'bg-grey': '')}}">
                    <i class="fas fa-map-marker-alt fa-md mr-1"></i>
                    {{($user->city != "-" && $user->city != "" ? getCityName($user->city) : "Sin ciudad" )}}, {{($user->region != "" ? getRegionName($user->region) : "Sin región" )}}
                  </label>
                  <label for="" class="label-gender {{getGenderLabelColor($user->gender)}}">{{getGender($user->gender)}}
                </div>
                <div class="col-12 col-md-6"><i class="fas fa-envelope fa-md text-secondary"></i> {{$user->email}}</div>
                <div class="col-12 col-md-6"><i class="fas fa-phone-alt fa-md text-secondary"></i> {{($user->telephone != "" ? $user->telephone : "Sin teléfono" )}}</div>
                <div class="col-12 my-2"><i class="fas fa-utensils fa-md mr-2 text-secondary"></i>{{$user->resto_type}}</div>
              </div>
              <div class="col-12 col-md-2">
                <a href="/users/{{$user->id}}" class="btn btn-primary">Ver</a>
              </div>
            </div>
          @endforeach
          </div>
        @else
          <h4 class="text-center">No hay usuarios registrados con esas características</h4>
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
    getRegion(inputValue, {{$param['city']}});

    $('#user-selected-all').change(function(){
      if($('#user-selected-all').prop('checked')){
        $("input[name='user-selected']").prop("checked", true);
      }else{
        $("input[name='user-selected']").prop("checked", false);
      }
    });
    $('#selected_region_list').change(function(){
        var inputValue = $(this).val();
        getRegion(inputValue, {{$param['city']}});
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

