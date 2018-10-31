// --------- function -------

// ---------- EVENT -------------
$(document).on("click", "#delete-adver", function( event ) {

  var url  = $(this).attr("data-url");

  console.log(url);

  $.ajax({
    url : url,
    data:"",
    type : 'POST',
    success : function(data, statut){
      console.log(data);
    }
  });

  event.preventDefault();
  return false
});