// ----------------------------- functions -----------------------------

// ------------------------------ Events -------------------------------

$(document).on("click", "#box-received", function( event ) {

    var url  = $(this).attr("data-url");

    console.log(url);

    $.ajax({
        url : url,
        data:"",
        type : 'POST',
        success : function(data, statut){
            $('.mail-body-content').html(data);
        }
    });

    event.preventDefault();
    return false
});