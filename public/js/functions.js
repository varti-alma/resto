const getRegion = async (idRegion) => {
  const api = await fetch('/getCity/'+idRegion);
  const cityList = await api.json();
  $("#city option").each(function() {
    $(this).remove();
  });
  Object.keys(cityList).map((row) => {
    data = cityList[row];
    $('#city').prepend("<option value='"+data['code']+"' >"+data["name"]+"</option>")
  });
  return data;
}

const filterPeopleList = async (CSRF_TOKEN) => {
  const region = $('#selected_region_list').val();
  const city = $('#city').val();
  const api = await fetch('/filterPeopleList/', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': CSRF_TOKEN,
    },
    body: JSON.stringify({
      'region': region,
      'city': city,
    })
  }).catch((error) => {
    console.error('Error:', error);
  });
  const result = await api.json();
  console.log(result);
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
