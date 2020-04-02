<?php
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
    /*
    echo '---'.$id.'---';
    echo '<pre>';
    print_r($param);
    echo '</pre>';
    echo "Hola";
    echo '<pre>';
    print_r($idList);
    echo '</pre>';
    echo array_key_exists($param, $idList);
    */
    if(array_key_exists($param, $idList)){
      $found = in_array($id, $idList);
      // print_r($found);
      // exit;
      if($found)
        return 'checked';
      else
        return '';
    }
    exit;
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
      return "Usuario";
    else
      return "Restaurante";
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

  function getRegionName($region){
    if($region != ""){
      $regionList = regionList();
      return $regionList[$region];
    }
    return '-';
  }

  function getCityName($city){
    if($city != ""){
      $region = preg_split('/-/', $city);
      $cityList = cityList($region[0]);
      return $cityList[$city];
    }
    return '-';
  }

  function regionList(){
    return array(
      'I' => 'Región de Tarapacá',
      'II' => 'Región de Antofagasta',
      'III' => 'Región de Atacama',
      'IV' => 'Región de Coquimbo',
      'V' => 'Región de Valparaíso',
      'VI' => 'Región del Libertador General Bernardo O’Higgins',
      'VII' => 'Región del Maule',
      'VIII' => 'Región del Biobío',
      'IX' => 'Región de La Araucanía',
      'X' => 'Región de Los Lagos',
      'XI' => 'Región Aysén del General Carlos Ibáñez del Campo',
      'XII' => 'Región de Magallanes y Antártica Chilena',
      'RM' => 'Región Metropolitana de Santiago',
      'XIV' => 'Región de Los Ríos',
      'XV' => 'Región de Arica y Parinacota',
      'XVI'  => 'Región de Ñuble'
    );
  }

  function cityList($region){
    switch ($region) {
      case 'XV': // Región de Arica y Parinacota
        return array(
          'XV-1' => "Arica",
          'XV-2' => "Camarones",
          'XV-3' => 'General Lagos',
          'XV-4' => 'Putre'
        );
        break;
      case 'I': // Región de Tarapacá
        return array(
          'I-1' => 'Alto Hospicio',
          'I-2' => 'Iquique',
          'I-3' => 'Camiña',
          'I-4' => 'Colchane',
          'I-5' => 'Huara',
          'I-6' => 'Pica',
          'I-7' => 'Pozo Almonte'
        );
        break;
      case 'II': // Región de Antofagasta
        return array(
          'II-1' => 'Antofagasta',
          'II-2' => 'Mejillones',
          'II-3' => 'Sierra Gorda',
          'II-4' => 'Taltal',
          'II-5' => 'Calama',
          'II-6' => 'Ollague',
          'II-7' => 'San Pedro de Atacama',
          'II-8' => 'Maria Elena',
          'II-9' => 'Tocopilla'
        );
        break;
      case 'III': // Región de Atacama
        return array(
          'III-1' => 'Chañaral',
          'III-2' => 'Diego de Almagro',
          'III-3' => 'Caldera',
          'III-4' => 'Copiapó',
          'III-5' => 'Tierra Amarilla',
          'III-6' => 'Alto del Carmen',
          'III-7' => 'Freirina',
          'III-8' => 'Huasco',
          'III-9' => 'Vallenar'
        );
        break;
      case 'IV': // Región de Coquimbo
        return array(
          'IV-1' => 'Canela',
          'IV-2' => 'Illapel',
          'IV-3' => 'Los Vilos',
          'IV-4' => 'Salamanca',
          'IV-5' => 'Andacollo',
          'IV-6' => 'Coquimbo',
          'IV-7' => 'La Higuera',
          'IV-8' => 'La serena',
          'IV-9' => 'Paihuano',
          'IV-10' => 'Vicuña',
          'IV-11' => 'Combarbalá',
          'IV-12' => 'Monte Patria',
          'IV-13' => 'Ovalle',
          'IV-14' => 'Punitaqui',
          'IV-15' => 'Río Hurtado'
        );
        break;
      case 'V':
        return array(
          'V-1' => 'Isla de Pascua',
          'V-2' => 'Calle Larga',
          'V-3' => 'Los Andes',
          'V-4' => 'Rinconada',
          'V-5' => 'San Esteban',
          'V-6' => 'Cabildo',
          'V-7' => 'La Ligua',
          'V-8' => 'Papudo',
          'V-9' => 'Petorca',
          'V-10' => 'Zapallar',
          'V-11' => 'Hijuelas',
          'V-12' => 'Caldera',
          'V-13' => 'La Cruz',
          'V-14' => 'Nogales',
          'V-15' => 'Quillota',
          'V-16' => 'Algarrobo',
          'V-17' => 'Cartagena',
          'V-18' => 'El Quisco',
          'V-19' => 'El Tabo',
          'V-20' => 'San Antonio',
          'V-21' => 'Santo Domingo',
          'V-22' => 'Catemu',
          'V-23' => 'Llay Llay',
          'V-24' => 'Panquehue',
          'V-25' => 'Putaendo',
          'V-26' => 'San Felipe',
          'V-27' => 'Santa María',
          'V-28' => 'Casa Blanca',
          'V-29' => 'Concón',
          'V-30' => 'Juan Fernández',
          'V-31' => 'Puchuncaví',
          'V-32' => 'Quintero',
          'V-33' => 'Valparaíso',
          'V-34' => 'Viña del Mar',
          'V-35' => 'Limache',
          'V-36' => 'Olmué',
          'V-37' => 'Quilpué',
          'V-38' => 'Villa Alemana'
        );
        break;
      case 'RM':
        return array(
          'RM-1' => 'Colina',
          'RM-2' => 'Lampa',
          'RM-3' => 'Tiltil',
          'RM-4' => 'Pirque',
          'RM-5' => 'Puente Alto',
          'RM-6' => 'San José de Maipo',
          'RM-7' => 'Buin',
          'RM-8' => 'Calera de Tango',
          'RM-9' => 'Paine',
          'RM-10' => 'San Bernardo',
          'RM-11' => 'Alhué',
          'RM-12' => 'Curacaví',
          'RM-13' => 'María Pinto',
          'RM-14' => 'Melipilla',
          'RM-15' => 'San Pedro',
          'RM-16' => 'Cerrillo',
          'RM-17' => 'Cerro Navia',
          'RM-18' => 'Conchalí',
          'RM-19' => 'El Bosque',
          'RM-20' => 'Estación Central',
          'RM-21' => 'Huechuraba',
          'RM-22' => 'Independencia',
          'RM-23' => 'La Cisterna',
          'RM-24' => 'La Granja',
          'RM-25' => 'La Florida',
          'RM-26' => 'La Pintana',
          'RM-27' => 'La Reina',
          'RM-28' => 'Las Condes',
          'RM-29' => 'Lo Barnechea',
          'RM-30' => 'Lo Espajo',
          'RM-31' => 'Lo Prado',
          'RM-32' => 'Macul',
          'RM-33' => 'Maipú',
          'RM-34' => 'Ñuñoa',
          'RM-35' => 'Pedro Aguirre Cerda',
          'RM-36' => 'Peñalolén',
          'RM-37' => 'Providencia',
          'RM-38' => 'Pudahuel',
          'RM-39' => 'Quilicura',
          'RM-40' => 'Quinta Normal',
          'RM-41' => 'Recoleta',
          'RM-42' => 'Renca',
          'RM-43' => 'San Miguel',
          'RM-44' => 'San Joaquín',
          'RM-45' => 'San Ramón',
          'RM-46' => 'Santiago',
          'RM-47' => 'Vitacura',
          'RM-48' => 'El Monte',
          'RM-49' => 'Isla de Maipo',
          'RM-50' => 'Padre Hurtado',
          'RM-51' => 'Peñaflor',
          'RM-52' => 'Talagante'
        );
        break;
      case 'VI':
        return array(
          'VI-1' => 'Codegua',
          'VI-2' => 'Coinco',
          'VI-3' => 'Coltauco',
          'VI-4' => 'Doñihue',
          'VI-5' => 'Graneros',
          'VI-6' => 'Las Cabras',
          'VI-7' => 'Machalí',
          'VI-8' => 'Malloa',
          'VI-9' => 'Mostazal',
          'VI-10' => 'Olivar',
          'VI-11' => 'Peumo',
          'VI-12' => 'Pichidegua',
          'VI-13' => 'Quinta de Tilcoco',
          'VI-14' => 'Rancagua',
          'VI-15' => 'Rengo',
          'VI-16' => 'Requinoa',
          'VI-17' => 'San Vicente de Tagua Tagua',
          'VI-18' => 'La Estrella',
          'VI-19' => 'Litueche',
          'VI-20' => 'Marchigüe',
          'VI-21' => 'Navidad',
          'VI-22' => 'Paredones',
          'VI-23' => 'Pichilemu',
          'VI-24' => 'Chépica',
          'VI-25' => 'Chimbarongo',
          'VI-26' => 'Lol Lol',
          'VI-27' => 'Nancagua',
          'VI-28' => 'Palmilla',
          'VI-29' => 'Peralillo',
          'VI-30' => 'Placilla',
          'VI-31' => 'Pumanque',
          'VI-32' => 'San Fernando',
          'VI-33' => 'Santa Cruz'
        );
        break;
      case 'VII':
        return array(
          'VII-1' => 'Cauquenes',
          'VII-2' => 'Chanco',
          'VII-3' => 'Pelluhue',
          'VII-4' => 'Curicó',
          'VII-5' => 'Huarañé',
          'VII-6' => 'Licantén',
          'VII-7' => 'Molina',
          'VII-8' => 'Rauco',
          'VII-9' => 'Romeral',
          'VII-10' => 'Sagrada Fmilia',
          'VII-11' => 'Teno',
          'VII-12' => 'Vichuquén',
          'VII-13' => 'Colbún',
          'VII-14' => 'Linares',
          'VII-15' => 'Longaví',
          'VII-16' => 'Parral',
          'VII-17' => 'Retiro',
          'VII-18' => 'San Javier',
          'VII-19' => 'Villa Alegre',
          'VII-20' => 'Yerbas Buenas',
          'VII-21' => 'Constitución',
          'VII-22' => 'Curepto',
          'VII-23' => 'Empedrado',
          'VII-24' => 'Maule',
          'VII-25' => 'Pelarco',
          'VII-26' => 'Pencahue',
          'VII-27' => 'Río Claro',
          'VII-28' => 'San Clemente',
          'VII-29' => 'San Rafael',
          'VII-30' => 'Talca'
        );
        break;
      case 'XVI':
        return array(
          'XVI-1' => 'Coquebcura',
          'XVI-2' => 'Coelemu',
          'XVI-3' => 'Ninhue',
          'XVI-4' => 'Portezuelo',
          'XVI-5' => 'Quirihue',
          'XVI-6' => 'Ránquil',
          'XVI-7' => 'Trehuaco',
          'XVI-8' => 'Bulnes',
          'XVI-9' => 'Chillán Viejo',
          'XVI-10' => 'Chillán',
          'XVI-11' => 'El Carmen',
          'XVI-12' => 'Pemuco',
          'XVI-13' => 'Pinto',
          'XVI-14' => 'Quillón',
          'XVI-15' => 'San Ignacio',
          'XVI-16' => 'Yungay',
          'XVI-17' => 'Coihueco',
          'XVI-18' => 'Niquén',
          'XVI-19' => 'San Carlos',
          'XVI-20' => 'San Fabián',
          'XVI-21' => 'San Nicolás'
        );
        break;
      case 'VIII':
        return array(
          'VIII-1' => 'Arauco',
          'VIII-2' => 'Cañete',
          'VIII-3' => 'Contulmo',
          'VIII-4' => 'Curanilahue',
          'VIII-5' => 'Lebu',
          'VIII-6' => 'Los Álamo',
          'VIII-7' => 'Tirua',
          'VIII-8' => 'Alto Bio Bío',
          'VIII-9' => 'Antuco',
          'VIII-10' => 'Cabrero',
          'VIII-11' => 'Laja',
          'VIII-12' => 'Los Ángeles',
          'VIII-13' => 'Mulchén',
          'VIII-14' => 'Nacimiento',
          'VIII-15' => 'Negrete',
          'VIII-16' => 'Quilaco',
          'VIII-17' => 'Quilleco',
          'VIII-18' => 'San Rosendo',
          'VIII-19' => 'Santa Bárbara',
          'VIII-20' => 'Tucapel',
          'VIII-21' => 'Yumbel',
          'VIII-22' => 'Chiguayante',
          'VIII-23' => 'Concepción',
          'VIII-24' => 'Coronel',
          'VIII-25' => 'Florida',
          'VIII-26' => 'Hualpén',
          'VIII-27' => 'Hualqui',
          'VIII-28' => 'Lota',
          'VIII-29' => 'Penco',
          'VIII-30' => 'San Pedro de la Paz',
          'VIII-31' => 'Santa Juana',
          'VIII-32' => 'Talcahuano',
          'VIII-33' => 'Tomé'
        );
        break;
      case 'IX':
        return array(
          'IX-1' => 'Carahue',
          'IX-2' => 'Cholchol',
          'IX-3' => 'Cunco',
          'IX-4' => 'Curarrehue',
          'IX-5' => 'Freire',
          'IX-6' => 'Galvarino',
          'IX-7' => 'Gorbea',
          'IX-8' => 'Lautaro',
          'IX-9' => 'Loncoche',
          'IX-10' => 'Melipeumo',
          'IX-11' => 'Nueva Imperial',
          'IX-12' => 'Padre las Casas',
          'IX-13' => 'Perquenco',
          'IX-14' => 'Pitrufquén',
          'IX-15' => 'Pucón',
          'IX-16' => 'Puerto Saavedra',
          'IX-17' => 'Temuco',
          'IX-18' => 'Teodoro Schmidt',
          'IX-19' => 'Toltén',
          'IX-20' => 'Vilcún',
          'IX-21' => 'Villarica',
          'IX-22' => 'Angol',
          'IX-23' => 'Collipulli',
          'IX-24' => 'Curacautín',
          'IX-25' => 'Ercilla',
          'IX-26' => 'Lonquimai',
          'IX-27' => 'Los Sauces',
          'IX-28' => 'Lumaco',
          'IX-29' => 'Purén',
          'IX-30' => 'Renaico',
          'IX-31' => 'Traiguén',
          'IX-32' => 'Victoria'
        );
        break;
      case 'XIV':
        return array(
          'XIV-1' => 'Corral',
          'XIV-2' => 'Lanco',
          'XIV-3' => 'Los Lagos',
          'XIV-4' => 'Marfil',
          'XIV-5' => 'Mariquina',
          'XIV-6' => 'Paillaco',
          'XIV-7' => 'Panguipulli',
          'XIV-8' => 'Valdivia',
          'XIV-9' => 'Futrono',
          'XIV-10' => 'La Unión',
          'XIV-11' => 'Lago Ranco',
          'XIV-12' => 'Río Bueno'
        );
        break;
      case 'X':
        return array(
          'X-1' => 'Ancud',
          'X-2' => 'Castro',
          'X-3' => 'Chonchi',
          'X-4' => 'Curaco de Vélez',
          'X-5' => 'Dalcahue',
          'X-6' => 'Puqueldón',
          'X-7' => 'Queilén',
          'X-8' => 'Quemchi',
          'X-9' => 'Quellón',
          'X-10' => 'Quinchao',
          'X-11' => 'Calbuco',
          'X-12' => 'Cochamó',
          'X-13' => 'Fresia',
          'X-14' => 'Frutillar',
          'X-15' => 'Llanquihue',
          'X-16' => 'Los Muermos',
          'X-17' => 'Maullín',
          'X-18' => 'Puerto Montt',
          'X-19' => 'Puerto Varas',
          'X-20' => 'Osorno',
          'X-21' => 'Puerto Octay',
          'X-22' => 'Purranque',
          'X-23' => 'Pullehue',
          'X-24' => 'Río Negro',
          'X-25' => 'San Juan de la Costa',
          'X-26' => 'San Pablo',
          'X-27' => 'Chaitén',
          'X-28' => 'Futaleufú',
          'X-29' => 'Hualaihué',
          'X-30' => 'Palena'
        );
        break;
      case 'XI':
        return array(
          'XI-1' => 'Aysén',
          'XI-2' => 'Cisne',
          'XI-3' => 'Guaitecas',
          'XI-4' => 'Cochrane',
          'XI-5' => "O'Higgins",
          'XI-6' => 'Cohyaique',
          'XI-7' => 'Lago Verde',
          'XI-8' => 'Chile Chico',
          'XI-9' => 'Río Ibáñez'
        );
        break;
      case 'XII':
        return array(
          'XII-1' => 'Antártica',
          'XII-2' => 'Cabo de Hornos',
          'XII-3' => 'Laguna Blanca',
          'XII-4' => 'Punta Arenas',
          'XII-5' => 'Río Verde',
          'XII-6' => 'San Gregorio',
          'XII-7' => 'Porvenir',
          'XII-8' => 'Primavera',
          'XII-9' => 'Timaukel',
          'XII-10' => 'Natales',
          'XII-11' => 'Torres del Paine'
        );
        break;
      default:
        return ['-' => 'Por favor seleccione una región'];
        break;
    }
  }
  function cityStateJson(){
    return array(
      'XV-1' => "Arica",
      'XV-2' => "Camarones",
      'XV-3' => 'General Lagos',
      'XV-4' => 'Putre',
      'I-1' => 'Alto Hospicio',
      'I-2' => 'Iquique',
      'I-3' => 'Camiña',
      'I-4' => 'Colchane',
      'I-5' => 'Huara',
      'I-6' => 'Pica',
      'I-7' => 'Pozo Almonte',
      'II-1' => 'Antofagasta',
      'II-2' => 'Mejillones',
      'II-3' => 'Sierra Gorda',
      'II-4' => 'Taltal',
      'II-5' => 'Calama',
      'II-6' => 'Ollague',
      'II-7' => 'San Pedro de Atacama',
      'II-8' => 'Maria Elena',
      'II-9' => 'Tocopilla',
      'III-1' => 'Chañaral',
      'III-2' => 'Diego de Almagro',
      'III-3' => 'Caldera',
      'III-4' => 'Copiapó',
      'III-5' => 'Tierra Amarilla',
      'III-6' => 'Alto del Carmen',
      'III-7' => 'Freirina',
      'III-8' => 'Huasco',
      'III-9' => 'Vallenar',
      'IV-1' => 'Canela',
      'IV-2' => 'Illapel',
      'IV-3' => 'Los Vilos',
      'IV-4' => 'Salamanca',
      'IV-5' => 'Andacollo',
      'IV-6' => 'Coquimbo',
      'IV-7' => 'La Higuera',
      'IV-8' => 'La serena',
      'IV-9' => 'Paihuano',
      'IV-10' => 'Vicuña',
      'IV-11' => 'Combarbalá',
      'IV-12' => 'Monte Patria',
      'IV-13' => 'Ovalle',
      'IV-14' => 'Punitaqui',
      'IV-15' => 'Río Hurtado',
      'V-1' => 'Isla de Pascua',
      'V-2' => 'Calle Larga',
      'V-3' => 'Los Andes',
      'V-4' => 'Rinconada',
      'V-5' => 'San Esteban',
      'V-6' => 'Cabildo',
      'V-7' => 'La Ligua',
      'V-8' => 'Papudo',
      'V-9' => 'Petorca',
      'V-10' => 'Zapallar',
      'V-11' => 'Hijuelas',
      'V-12' => 'Caldera',
      'V-13' => 'La Cruz',
      'V-14' => 'Nogales',
      'V-15' => 'Quillota',
      'V-16' => 'Algarrobo',
      'V-17' => 'Cartagena',
      'V-18' => 'El Quisco',
      'V-19' => 'El Tabo',
      'V-20' => 'San Antonio',
      'V-21' => 'Santo Domingo',
      'V-22' => 'Catemu',
      'V-23' => 'Llay Llay',
      'V-24' => 'Panquehue',
      'V-25' => 'Putaendo',
      'V-26' => 'San Felipe',
      'V-27' => 'Santa María',
      'V-28' => 'Casa Blanca',
      'V-29' => 'Concón',
      'V-30' => 'Juan Fernández',
      'V-31' => 'Puchuncaví',
      'V-32' => 'Quintero',
      'V-33' => 'Valparaíso',
      'V-34' => 'Viña del Mar',
      'V-35' => 'Limache',
      'V-36' => 'Olmué',
      'V-37' => 'Quilpué',
      'V-38' => 'Villa Alemana',
      'RM-1' => 'Colina',
      'RM-2' => 'Lampa',
      'RM-3' => 'Tiltil',
      'RM-4' => 'Pirque',
      'RM-5' => 'Puente Alto',
      'RM-6' => 'San José de Maipo',
      'RM-7' => 'Buin',
      'RM-8' => 'Calera de Tango',
      'RM-9' => 'Paine',
      'RM-10' => 'San Bernardo',
      'RM-11' => 'Alhué',
      'RM-12' => 'Curacaví',
      'RM-13' => 'María Pinto',
      'RM-14' => 'Melipilla',
      'RM-15' => 'San Pedro',
      'RM-16' => 'Cerrillo',
      'RM-17' => 'Cerro Navia',
      'RM-18' => 'Conchalí',
      'RM-19' => 'El Bosque',
      'RM-20' => 'Estación Central',
      'RM-21' => 'Huechuraba',
      'RM-22' => 'Independencia',
      'RM-23' => 'La Cisterna',
      'RM-24' => 'La Granja',
      'RM-25' => 'La Florida',
      'RM-26' => 'La Pintana',
      'RM-27' => 'La Reina',
      'RM-28' => 'Las Condes',
      'RM-29' => 'Lo Barnechea',
      'RM-30' => 'Lo Espajo',
      'RM-31' => 'Lo Prado',
      'RM-32' => 'Macul',
      'RM-33' => 'Maipú',
      'RM-34' => 'Ñuñoa',
      'RM-35' => 'Pedro Aguirre Cerda',
      'RM-36' => 'Peñalolén',
      'RM-37' => 'Providencia',
      'RM-38' => 'Pudahuel',
      'RM-39' => 'Quilicura',
      'RM-40' => 'Quinta Normal',
      'RM-41' => 'Recoleta',
      'RM-42' => 'Renca',
      'RM-43' => 'San Miguel',
      'RM-44' => 'San Joaquín',
      'RM-45' => 'San Ramón',
      'RM-46' => 'Santiago',
      'RM-47' => 'Vitacura',
      'RM-48' => 'El Monte',
      'RM-49' => 'Isla de Maipo',
      'RM-50' => 'Padre Hurtado',
      'RM-51' => 'Peñaflor',
      'RM-52' => 'Talagante',
      'VI-1' => 'Codegua',
      'VI-2' => 'Coinco',
      'VI-3' => 'Coltauco',
      'VI-4' => 'Doñihue',
      'VI-5' => 'Graneros',
      'VI-6' => 'Las Cabras',
      'VI-7' => 'Machalí',
      'VI-8' => 'Malloa',
      'VI-9' => 'Mostazal',
      'VI-10' => 'Olivar',
      'VI-11' => 'Peumo',
      'VI-12' => 'Pichidegua',
      'VI-13' => 'Quinta de Tilcoco',
      'VI-14' => 'Rancagua',
      'VI-15' => 'Rengo',
      'VI-16' => 'Requinoa',
      'VI-17' => 'San Vicente de Tagua Tagua',
      'VI-18' => 'La Estrella',
      'VI-19' => 'Litueche',
      'VI-20' => 'Marchigüe',
      'VI-21' => 'Navidad',
      'VI-22' => 'Paredones',
      'VI-23' => 'Pichilemu',
      'VI-24' => 'Chépica',
      'VI-25' => 'Chimbarongo',
      'VI-26' => 'Lol Lol',
      'VI-27' => 'Nancagua',
      'VI-28' => 'Palmilla',
      'VI-29' => 'Peralillo',
      'VI-30' => 'Placilla',
      'VI-31' => 'Pumanque',
      'VI-32' => 'San Fernando',
      'VI-33' => 'Santa Cruz',
      'VII-1' => 'Cauquenes',
      'VII-2' => 'Chanco',
      'VII-3' => 'Pelluhue',
      'VII-4' => 'Curicó',
      'VII-5' => 'Huarañé',
      'VII-6' => 'Licantén',
      'VII-7' => 'Molina',
      'VII-8' => 'Rauco',
      'VII-9' => 'Romeral',
      'VII-10' => 'Sagrada Fmilia',
      'VII-11' => 'Teno',
      'VII-12' => 'Vichuquén',
      'VII-13' => 'Colbún',
      'VII-14' => 'Linares',
      'VII-15' => 'Longaví',
      'VII-16' => 'Parral',
      'VII-17' => 'Retiro',
      'VII-18' => 'San Javier',
      'VII-19' => 'Villa Alegre',
      'VII-20' => 'Yerbas Buenas',
      'VII-21' => 'Constitución',
      'VII-22' => 'Curepto',
      'VII-23' => 'Empedrado',
      'VII-24' => 'Maule',
      'VII-25' => 'Pelarco',
      'VII-26' => 'Pencahue',
      'VII-27' => 'Río Claro',
      'VII-28' => 'San Clemente',
      'VII-29' => 'San Rafael',
      'VII-30' => 'Talca',
      'XVI-1' => 'Coquebcura',
      'XVI-2' => 'Coelemu',
      'XVI-3' => 'Ninhue',
      'XVI-4' => 'Portezuelo',
      'XVI-5' => 'Quirihue',
      'XVI-6' => 'Ránquil',
      'XVI-7' => 'Trehuaco',
      'XVI-8' => 'Bulnes',
      'XVI-9' => 'Chillán Viejo',
      'XVI-10' => 'Chillán',
      'XVI-11' => 'El Carmen',
      'XVI-12' => 'Pemuco',
      'XVI-13' => 'Pinto',
      'XVI-14' => 'Quillón',
      'XVI-15' => 'San Ignacio',
      'XVI-16' => 'Yungay',
      'XVI-17' => 'Coihueco',
      'XVI-18' => 'Niquén',
      'XVI-19' => 'San Carlos',
      'XVI-20' => 'San Fabián',
      'XVI-21' => 'San Nicolás',
      'VIII-1' => 'Arauco',
      'VIII-2' => 'Cañete',
      'VIII-3' => 'Contulmo',
      'VIII-4' => 'Curanilahue',
      'VIII-5' => 'Lebu',
      'VIII-6' => 'Los Álamo',
      'VIII-7' => 'Tirua',
      'VIII-8' => 'Alto Bio Bío',
      'VIII-9' => 'Antuco',
      'VIII-10' => 'Cabrero',
      'VIII-11' => 'Laja',
      'VIII-12' => 'Los Ángeles',
      'VIII-13' => 'Mulchén',
      'VIII-14' => 'Nacimiento',
      'VIII-15' => 'Negrete',
      'VIII-16' => 'Quilaco',
      'VIII-17' => 'Quilleco',
      'VIII-18' => 'San Rosendo',
      'VIII-19' => 'Santa Bárbara',
      'VIII-20' => 'Tucapel',
      'VIII-21' => 'Yumbel',
      'VIII-22' => 'Chiguayante',
      'VIII-23' => 'Concepción',
      'VIII-24' => 'Coronel',
      'VIII-25' => 'Florida',
      'VIII-26' => 'Hualpén',
      'VIII-27' => 'Hualqui',
      'VIII-28' => 'Lota',
      'VIII-29' => 'Penco',
      'VIII-30' => 'San Pedro de la Paz',
      'VIII-31' => 'Santa Juana',
      'VIII-32' => 'Talcahuano',
      'VIII-33' => 'Tomé',
      'IX-1' => 'Carahue',
      'IX-2' => 'Cholchol',
      'IX-3' => 'Cunco',
      'IX-4' => 'Curarrehue',
      'IX-5' => 'Freire',
      'IX-6' => 'Galvarino',
      'IX-7' => 'Gorbea',
      'IX-8' => 'Lautaro',
      'IX-9' => 'Loncoche',
      'IX-10' => 'Melipeumo',
      'IX-11' => 'Nueva Imperial',
      'IX-12' => 'Padre las Casas',
      'IX-13' => 'Perquenco',
      'IX-14' => 'Pitrufquén',
      'IX-15' => 'Pucón',
      'IX-16' => 'Puerto Saavedra',
      'IX-17' => 'Temuco',
      'IX-18' => 'Teodoro Schmidt',
      'IX-19' => 'Toltén',
      'IX-20' => 'Vilcún',
      'IX-21' => 'Villarica',
      'IX-22' => 'Angol',
      'IX-23' => 'Collipulli',
      'IX-24' => 'Curacautín',
      'IX-25' => 'Ercilla',
      'IX-26' => 'Lonquimai',
      'IX-27' => 'Los Sauces',
      'IX-28' => 'Lumaco',
      'IX-29' => 'Purén',
      'IX-30' => 'Renaico',
      'IX-31' => 'Traiguén',
      'IX-32' => 'Victoria',
      'XIV-1' => 'Corral',
      'XIV-2' => 'Lanco',
      'XIV-3' => 'Los Lagos',
      'XIV-4' => 'Marfil',
      'XIV-5' => 'Mariquina',
      'XIV-6' => 'Paillaco',
      'XIV-7' => 'Panguipulli',
      'XIV-8' => 'Valdivia',
      'XIV-9' => 'Futrono',
      'XIV-10' => 'La Unión',
      'XIV-11' => 'Lago Ranco',
      'XIV-12' => 'Río Bueno',
      'X-1' => 'Ancud',
      'X-2' => 'Castro',
      'X-3' => 'Chonchi',
      'X-4' => 'Curaco de Vélez',
      'X-5' => 'Dalcahue',
      'X-6' => 'Puqueldón',
      'X-7' => 'Queilén',
      'X-8' => 'Quemchi',
      'X-9' => 'Quellón',
      'X-10' => 'Quinchao',
      'X-11' => 'Calbuco',
      'X-12' => 'Cochamó',
      'X-13' => 'Fresia',
      'X-14' => 'Frutillar',
      'X-15' => 'Llanquihue',
      'X-16' => 'Los Muermos',
      'X-17' => 'Maullín',
      'X-18' => 'Puerto Montt',
      'X-19' => 'Puerto Varas',
      'X-20' => 'Osorno',
      'X-21' => 'Puerto Octay',
      'X-22' => 'Purranque',
      'X-23' => 'Pullehue',
      'X-24' => 'Río Negro',
      'X-25' => 'San Juan de la Costa',
      'X-26' => 'San Pablo',
      'X-27' => 'Chaitén',
      'X-28' => 'Futaleufú',
      'X-29' => 'Hualaihué',
      'X-30' => 'Palena',
      'XI-1' => 'Aysén',
      'XI-2' => 'Cisne',
      'XI-3' => 'Guaitecas',
      'XI-4' => 'Cochrane',
      'XI-5' => "O'Higgins",
      'XI-6' => 'Cohyaique',
      'XI-7' => 'Lago Verde',
      'XI-8' => 'Chile Chico',
      'XI-9' => 'Río Ibáñez',
      'XII-1' => 'Antártica',
      'XII-2' => 'Cabo de Hornos',
      'XII-3' => 'Laguna Blanca',
      'XII-4' => 'Punta Arenas',
      'XII-5' => 'Río Verde',
      'XII-6' => 'San Gregorio',
      'XII-7' => 'Porvenir',
      'XII-8' => 'Primavera',
      'XII-9' => 'Timaukel',
      'XII-10' => 'Natales',
      'XII-11' => 'Torres del Paine'
    );
  }

?>
