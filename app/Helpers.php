<?php
  use Illuminate\Support\Facades\Storage;

  function disabledInput($id, $idUser){
    return $id == $idUser;
  }

  function checkedInput($id, $idListString){
    $idList = explode(', ', $idListString);
    $found = in_array($id, $idList);
    if($found)
      return 'checked';
    else
      return '';
  }

  function checkedInputArray($id, $idList, $param){
    if(array_key_exists($param, $idList)){
      $found = in_array($id, $idList);
      // print_r($found);
      // exit;
      if($found)
        return 'checked';
      else
        return '';
    }
    return '';
  }
  function checkedInputArrayHome($id, $idList, $param){
    if(array_key_exists($param, $idList)){
      $found = in_array($id, $idList[$param]);
      if($found)
        return 'checked';
      else
        return '';
    }
    return '';
  }
  function selectedInput($id, $idListString){
    $idList = explode(', ', $idListString);
    $found = in_array($id, $idList);
    if($found)
      return 'selected';
    else
      return '';
  }

  function getGender($gender){
    switch ($gender) {
      case '0': // Femenino
        return 'Mujer';
        break;
      case '1': // Masculino
        return 'Hombre';
        break;
      default: // No especificado
        return 'No especificado';
        break;
    }
  }

  function getGenderLabelColor($gender){
    switch ($gender) {
      case '0': // Femenino
        return 'bg-red';
        break;
      case '1': // Masculino
        return 'bg-blue';
        break;
      default: // No especificado
        return 'bg-grey';
        break;
    }
  }

  function userType($userType){
    if ($userType == "0")
      return "Perfil";
    else
      return "Perfil";
  }

  function getRestoTypeName($restoTypeList){
    if(count($restoTypeList) > 0){
      $text = array();
      foreach($restoTypeList as $key => $restoType){
        array_push($text, $restoType->description);
      }
      return implode(', ', $text);
    }
    return 'No hay tipo de restaurante informado';
  }

  function getCityListName($region){
    if($region != ""){
      $regionList = regionList();
      return $regionList[$region];
    }
    return '-';
  }

  function getCityName($city, $region){
    if($city != "" && $city != "-"  && $city != null){
      $cityList = collect(cityList($region));
      $cityData = $cityList->first(function ($ciudad, $key) use ($city) {
        return $ciudad["code"] == $city;
      });
      dd($cityData);
      return $cityData['name'];
    }
    return '-';
  }

  function regionList(){
    $json = file_get_contents(base_path('/public/regiones-provincias-comunas.json'));
    //$json = Storage::disk('public')->get('regiones-provincias-comunas.json');
    $list = json_decode($json, true);
    $collection = collect($list);
    return $collection->flatMap(function ($item, $key) {
      return [$item['region_number'] => $item["region"]];
    });
  }

  function cityList($region){
    $json = file_get_contents(base_path('/public/regiones-provincias-comunas.json'));
    //$json = Storage::disk('public')->get('regiones-provincias-comunas.json');
    $list = json_decode($json, true);

    $collection = collect($list);
    $filtered = $collection->firstWhere("region_number", $region);
    if(!$filtered) 
      return [["code" => "-", "name" => "Por favor seleccionar una región"]];
    else{
      $provincias = collect($filtered['provincias']);
      $result = $provincias->flatMap(function ($comuna, $key) {
        $comunas = collect($comuna['comunas']);
        return $comunas->map(function ($ciudad, $key) {
          return $ciudad;
        });
      })->sortBy('name')->all();
      return $result;
    }
  }

?>
