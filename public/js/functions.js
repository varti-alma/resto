const getRegion = async (idRegion) => {
  const api = await fetch('/getCity/'+idRegion);
  const data = await api.json();
  $("#city option").each(function() {
    $(this).remove();
  });
  Object.keys(data).map((row) =>
    $('#city').prepend("<option value='"+row+"' >"+data[row]+"</option>")
  );
  return data;
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

