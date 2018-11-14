// --------- function -------

// ---------- EVENT -------------
$(document).on("click", "#delete-adver", function( event ) {

  var url      = $(this).attr("data-url");
  var $parent  = this.closest("div .annonce");


  $.ajax({
    url : url,
    data:"",
    type : 'POST',
    success : function(data, statut){
      $parent.remove();
    }
  });

  event.preventDefault();
  return false
});