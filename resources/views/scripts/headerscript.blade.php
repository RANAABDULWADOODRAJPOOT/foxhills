


    var loc = document.querySelectorAll("a[data-id-page]");

  
    
    loc.forEach(node => {
        node.addEventListener("mouseover", locOver);
        node.addEventListener("mouseout", locOut);
    })




    function locOver(event) {
       var pageid = event.target.dataset.idPage;
       $("#tab_"+pageid).addClass("show");
    }

    function locOut() {
        if ($('.dropdown-menu:hover').length != 0) {
            var pageid = event.target.dataset.idPage;
            $("#tab_"+pageid).addClass("show");
        }
        else{
            var pageid = event.target.dataset.idPage;
            $("#tab_"+pageid).removeClass("show");
        }

    }
  

    $(document).click(function(event) { 
        var $target = $(event.target);
        if(!$target.closest('.dropdown-menu').length && 
        $('.dropdown-menu').is(":visible")) {
           $('.dropdown-menu').removeClass("show");
        }        
    });

 
    
  

   $(".closeheader").click(function() {
    $("#navbarCollapse").removeClass("show");
});