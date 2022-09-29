/* SCROLLSPY */

/* permet de créer une animation avec le scrollspy / navbar */

$(function(){
    
  $("#myNavbar a:not(#connexion), footer a ").on("click", function(event){
     
      event.preventDefault();
      var hash =this.hash;
      
      $('body, html').animate({scrollTop: $(hash).offset().top} , 900 , function(){window.location.hash=hash;})
      
  });
    
});

/* TIMELINE */

// préparation de base : timeline 2 invisible et timeline 1 visible
$(document).ready(function(){     
    $(function(){
        $("#timeline").hide();
        $("#timeline2").show();
    });
});

// quand je clique sur 2021-2022
$(document).ready(function(){ 
    $("#a2021").click(function(){
        $("#timeline").show();
        $("#timeline2").hide();
    });
});

// quand je clique sur 2022-2023
$(document).ready(function(){ 
    $("#a2022").click(function(){
        $("#timeline2").show();
        $("#timeline").hide();
    });
});