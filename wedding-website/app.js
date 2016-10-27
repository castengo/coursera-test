var main = function() {

  /* Food menu in and out */	
  $("#view-menu").click(function(){
        $(".invite-active").hide(1000);
        $(".menu-active").show(1000);
    });
  $("#view-invite").click(function() {
  		$(".menu-active").hide(1000);
  		$(".invite-active").show(1000);
  });

  /* Food-option */
  $("#attend-yes").click(function() {
  	$("#food-option").show();
  });

  $("#attend-no").click(function() {
  	$("#food-option").hide();
  });

  /* Help button */
  $("#help").click(function () {
  	$(".help-background").show(500);
  }); 
  $("#close-icon").click(function () {
  	$(".help-background").hide(500);
  });


};

$(document).ready(main);