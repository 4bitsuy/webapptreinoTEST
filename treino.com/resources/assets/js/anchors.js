$("#escuela").click(function() {
   scrollToAnchor('section-escuela');
});
$("#staff").click(function() {
   scrollToAnchor('section-staff');
});



function scrollToAnchor(aid){
    var aTag = $("#" + aid);
    $('html,body').animate({scrollTop: aTag.offset().top},'slow');
}
