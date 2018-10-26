// ----------------------------- functions -----------------------------

// ------------------------------ Events -------------------------------

$("#form_login").submit(function( event ) {

  var data = $(this).serialize();
  var url  = $(this).attr("action");

  $.ajax({
    url : url,
    data: data,
    type : 'POST',
    success : function(data, statut){
      console.log(data);
    }
  });

  event.preventDefault();
  return false
});
