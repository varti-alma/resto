/**
 * downloadFile. 
 *
 * Description. Función de descarga de csv según parámetro de filtros
 *
 * @param {string} CSRF_TOKEN    CSRF_TOKEN para llamar a Controlador.
 *
 */
const downloadFile = async (CSRF_TOKEN) => {
  var region = $('#selected_region_list').val();
  var city = $('#city').val();
  var experiences = [];
  var restos = [];

  $( "input[class='resto-selected']:checked" ).each(data =>{
    restos.push($( "input[class='resto-selected']:checked" )[data].value);
  })
  $( "input[class='experience-selected']:checked" ).each(data =>{
    experiences.push($( "input[class='experience-selected']:checked" )[data].value);
  })
  
  result = await fetch('/downloadCsv/', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': CSRF_TOKEN,
    },
    body: JSON.stringify({
      region,
      city,
      experiences,
      restos,
      'photo': false,
    })
  }).catch((error) => {
    console.error('Error:', error);
  });

  const data = await result.json()
  console.log('data: ', data);
  // let csv = Object.keys(data[0]).toString()+"\n";
  let csv = "nombre,apellidos,tel\u00E9fono,CI,regi\u00F3n,ciudad,email,g\u00E9nero,fecha de cumpleaos,direcci\u00F3n,experiencias,restaurantes\n"

  data.map( row => {
    csv += row['name'] + ',';
    csv += row['surname'] + ',';
    csv += row['telephone'] + ',';
    csv += row['document_id'] + ',';
    csv += row['region'] + ',';
    csv += row['city'] + ',';
    csv += row['email'] + ',';
    csv += row['gender'] + ',';
    csv += row['birthday'] + ',';
    csv += row['address'] + ',';
    csv += row['experiences'] + ',';
    csv += row['resto_type'] + "\n";
  });
  
  let today = new Date();
  const dd = String(today.getDate()).padStart(2, '0');
  const mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  const yyyy = today.getFullYear();
  const hh = today.getHours();
  const min = today.getMinutes();
  today = yyyy + '_' + mm + '_' + dd + '_' + hh + '_' + min;
  /*
  const hiddenElement = document.createElement('a');
  hiddenElement.href = 'data:text/csv;charset=utf-8,' + encodeURI(csv);
  hiddenElement.target = '_blank';
  hiddenElement.download = 'listado-personas-'+today+'.csv';
  hiddenElement.click();  
  */
}

/**
 * getCityList. 
 *
 * Description. Función que retorna listado de ciudades asociadas a la región
 *
 * @param {string} idRegion    id de la región informada.
 * @param {string} idCity      id de la ciudad informada para dejar la ciudad seleccionada
 *
 */
const getCityList = async (idRegion, idCity) => {
  const api = await fetch('/getCity/'+idRegion);
  const cityList = await api.json();
  $("#city option").each(function() {
    $(this).remove();
  });
  let data = [];
  if(idRegion === "-"){
    $('#city').prepend("<option value='-'>Todos</option>")
    data = [];
  } else {
    data = Object.values(cityList) 
    .sort(function order(key1, key2) { 
        if (key1.name > key2.name) return -1; 
        else if (key1.name < key2.name) return +1; 
        else return 0; 
    });  
    data.map((row) => {
      cityCode = parseInt(row.code);
      selected = cityCode === parseInt(idCity) ? "selected" : "";
      $('#city').prepend("<option value='"+row.code+"' "+selected+">"+row.name+"</option>")
    });  
    if(idCity === "-")
      $('#city').prepend("<option value='-' selected>Todos</option>")
    else if(!idCity)
      $('#city').prepend("<option value='-' selected>Por favor seleccione una ciudad</option>")
    else 
      $('#city').prepend("<option value='-'>Todos</option>")
  }
  return data;
}

/**
 * filterPeopleList. 
 *
 * Description. Función que retorna listado de usuarios según filtros informados
 *
 * @param {string} CSRF_TOKEN    CSRF_TOKEN para llamar a Controlador.
 *
 */
const filterPeopleList = async (CSRF_TOKEN) => {
  const region = $('#selected_region_list').val();
  const city = $('#city').val();
  await fetch('/filterPeopleList/', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': CSRF_TOKEN,
    },
    body: JSON.stringify({
      'region': region,
      'city': city,
      'photo': true,
    })
  }).catch((error) => {
    console.error('Error:', error);
  });
  $("#user-list").empty();
}

function searchList(event, list){
  var t = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
  if (t == 9 || t == 13){
    const filter = $('#'+list).children();
    const searchText = list === 'experience-list' ? $('#txtSearchExperience').val() : $('#txtSearchResto').val();
    if(searchText !== "")
      filter.map((key, row) => {
        if(row.children[1].innerHTML.toUpperCase() !== searchText.toUpperCase())
          $('.'+row.className).addClass('d-none');
        else
          $('.'+row.className).removeClass('d-none');
        console.log(row);
      });
    else
      filter.map((key, row) => {
          $('.'+row.className).removeClass('d-none');
      });

    return false;
  }
  return true;
}

function tab_btn(event){
  var t = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
  if (t == 9 || t == 13){
    const filter = $('#txtSkills').val();
    const id = $('.label-filter').length + 1 ;
    $('#filter-list').prepend('<div id="filter-'+id+'" type="button" class="btn label-filter">'+filter+' <span class="badge">x</span><span class="sr-only">'+filter+'</span></div>')
    $('#txtSkills').val('');
    return false;
  }
  return true;
}

