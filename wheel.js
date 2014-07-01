  	$(function() {
    	var $elie = $("#wheel"), degree = 0, timer;
    	rotate();
    	function rotate() {
      	$elie.css({
        	WebkitTransform: 'rotate(' + degree + 'deg)'});
      	$elie.css({
        	'-moz-transform': 'rotate(' + degree + 'deg)'});
      	timer = setTimeout(function() {
        	++degree;
        	rotate();
      	}
                         	,30);
    	}   	 
    	$("input").toggle(function() {
      	clearTimeout(timer);
    	}
                      	, function() {
                        	rotate();
                      	});
  	});
