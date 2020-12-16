$(document).ready(function() {

   $(".accordion h3, .accordion h2").click(function() {
      var parent = $(this).parents(".accordion")
      parent.toggleClass("active");

   })
})
