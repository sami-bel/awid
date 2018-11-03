// ----------------------------- functions -----------------------------
var showContentInMessageBody = function(url, params){

    $.ajax({
        url : url,
        data: params,
        type : 'POST',
        success : function(data, statut){
            $('.mail-body-content').html(data);
        }
    });

};

// ------------------------------ Events -------------------------------

$(document).on("click", "#box-received, #show-message, #box-send", function( event ) {

    var url  = $(this).attr("data-url");
    showContentInMessageBody(url, null);
    event.preventDefault();
    return false
});