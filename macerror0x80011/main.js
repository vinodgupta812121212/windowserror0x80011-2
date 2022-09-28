 $(document).ready(function() {
    var audioElement = document.createElement('audio');
    audioElement.setAttribute('src', 'alertmicrosoft.mp3');
    
    audioElement.addEventListener('ended', function() {
        this.play();
    }, false);
    
   
     $('.map').click(function() {
        audioElement.play();
        
    });

      $('.black').click(function() {
        audioElement.play();
        
    });
      

       $('#footer').click(function() {
        audioElement.play();
        
    });

        $('#poptxt').click(function() {
        audioElement.play();
        
    });
       
     
   
    
    
});

/* $("#footer").fadeIn('slow')
.css({top:752,position:'absolute'})
.animate({top:685}, 800, function() {
    //callback
});*/
$(document).ready(function() {
    $(".arow-div").delay(1000).fadeIn(500);
});

    $(document).ready(function(){
  $("#txts1").click(function(){
    $('#poptxt').fadeOut('fast');
    
  });
});


    $(document).ready(function(){
  $(".alert_popup").click(function(){
    $('.alert_popup').hide('fast');
  });
});
    


           $(document).ready(function(){
  $("#footer").click(function(){
     $('#poptxt').fadeOut('fast');
    $("#poptxt").delay(2000).fadeIn(800);
  });
});

                    $(document).ready(function(){
  $("#mycanvas").click(function(){
     $('#poptxt').fadeOut('fast');
    $("#poptxt").delay(2000).fadeIn(800);
  });
});


   $(document).ready(function(){
  $(".black").click(function(){
    $('.delayedPopupWindow').hide('fast');
  });
});

  


