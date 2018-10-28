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

        if(typeof data =='object')
        {
            if(data.error != "undefined"){
                $("#error_login").html(data.error);
            }
        }
        else
        {
            location.reload();
        }
    }
  });

  event.preventDefault();
  return false
});
