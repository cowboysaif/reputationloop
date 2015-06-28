
 $(function(){
 $.ajax({
	     url:"showreview.php",
                  type:"POST",
                  data:"actionfunction=showData&page=1",
        cache: false,
        success: function(response){
		   
		  $('#pagination').html(response);
		 	$('span.stars').stars();
		}
		
	   });
    $('#pagination').on('click','.page-numbers',function(){
       $page = $(this).attr('href');
	   $pageind = $page.indexOf('page=');
	   $page = $page.substring(($pageind+5));
       
	   $.ajax({
	     url:"showreview.php",
                  type:"POST",
                  data:"actionfunction=showData&page="+$page,
        cache: false,
        success: function(response){
		   
		  $('#pagination').html(response);
		 $('span.stars').stars();
		}
		
	   });
	   
	   
	return false;
	});
	
	  $('#num_of_review').on("change keyup paste click", function(){
        $page = $('#page_num').attr('value');
		

	   
	  $.ajax({
	     url:"showreview.php",
                  type:"POST",
                  data:"actionfunction=showData&page="+$page+"&num_of_review="+$('#num_of_review').val(),
        cache: false,
        success: function(response){
		  
		  $('#pagination').html(response);
		 $('span.stars').stars();
		}
		
	   });

	   
	   
	return false;
	});
	
	 $('#yelp').change(function() {
        $page = $('#page_num').attr('value');
	 $s = $("#yelp").is(':checked') ? 1 : 0;
	   
	  $.ajax({
	     url:"showreview.php",
                  type:"POST",
                  data:"actionfunction=showData&page="+$page+"&yelp="+  $s ,
        cache: false,
        success: function(response){
			
		    
		  $('#pagination').html(response);
		 $('span.stars').stars();
		}
		
	   });

	   
	   
	return false;
	});
	
	$('#google').change(function() {
        $page = $('#page_num').attr('value');
	 $s = $("#google").is(':checked') ? 1 : 0;
	   
	  $.ajax({
	     url:"showreview.php",
                  type:"POST",
                  data:"actionfunction=showData&page="+$page+"&google="+  $s ,
        cache: false,
        success: function(response){
		   
		 $('#pagination').html(response);
		 $('span.stars').stars();
		}
		
	   });

	   
	   
	return false;
	});
	
	$('#internal').change(function() {
        $page = $('#page_num').attr('value');
	 	$s = $("#internal").is(':checked') ? 1 : 0;
	   
	  $.ajax({
	     url:"showreview.php",
                  type:"POST",
                  data:"actionfunction=showData&page="+$page+"&internal="+  $s  ,
        cache: false,
        success: function(response){
		 
		  $('#pagination').html(response);
		 $('span.stars').stars();
		}
		
	   });

	   
	   
	return false;
	});
	
	$('#star').on("change keyup paste click", function(){
        $page = $('#page_num').attr('value');
		
	  $.ajax({
	     url:"showreview.php",
                  type:"POST",
                  data:"actionfunction=showData&page="+$page+"&star="+$('#star').val(),
        cache: false,
        success: function(response){
		   
		  $('#pagination').html(response);
		 $('span.stars').stars();
		}
		
	   });

	   
	   
	return false;
	});
	
});
	   

$.fn.stars = function() {
    return $(this).each(function() {
       
        var val = parseFloat($(this).html());
        
        var size = Math.max(0, (Math.min(5, val))) * 16;
        // Create stars holder
        var $span = $('<span />').width(size);
        // Replace the numerical value with stars
        $(this).html($span);
    });
}


