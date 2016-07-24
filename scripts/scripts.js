
$(document).ready(function() {
    $('#alert').fadeTo(2000, 500).slideUp(500);

    $('#myModal').on('shown.bs.modal', function() {
        $(this).removeData('bs.modal');
    });

    $("ul.nav-tabs a").click(function(e) {
        e.preventDefault();
        $(this).tab('show');
    });

    $('.slideshow').bxSlider({
    	randomStart:true,
    	controls:false,
    	auto:true,

    });

});
