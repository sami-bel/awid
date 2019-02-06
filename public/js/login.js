// ----------------------------- functions -----------------------------

// ------------------------------ Events -------------------------------

console.log('sami');
$(".form-login, #form_login").submit(function( event ) {

    console.log('ici00');
  var data = $(this).serialize();
  var url  = $(this).attr("action");

  $.ajax({
    url : url,
    data: data,
    type : 'POST',
    success : function(data, statut){

        console.log(data);
        if(typeof data =='object')
        {
            if(data.error != "undefined"){
                $("#error_login, .error_login").html(data.error);
            }
        }
        else
        {
            $(location).attr('href', '/');
            // location.reload("/");
        }
    }
  });

  event.preventDefault();
  return false
});
