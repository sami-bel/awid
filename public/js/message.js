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


$(document).on("click", "#send-message-from-detail", function( event ) {

    var url      = $(this).attr("data-url");

    var content  = $('#message-content').val();

    var params   =
        {
            "messageContent" : content
        };


    $.ajax({
        url : url,
        data:params,
        type : 'POST',
        success : function(data, statut){
            console.log(data);
        }
    });

    event.preventDefault();
    return false
});