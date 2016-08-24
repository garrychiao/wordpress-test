jQuery(document).ready(function($) {
	//CONTACT FORM VALIDATION
	$(document).ready(function($) {


	  $('#contactForm').submit(function(){
	    
	      $('.md-content').hide();
	      $('.launch_modal').trigger("click");
	      
	      $.ajax({
	        type: $("#contactForm").attr('method'),
	        url: $("#contactForm").attr('action'),
	        data: $("#contactForm").serialize(),
	        success: function(data) {
	          if(data == 'success')
	          {
	              $('#contactForm').each (function(){
	                  this.reset();
	              });
	              $('.md-content').show();
	          }
	          else
	          {
	            $('.md-content').show();
	            $('.md-content h3').html('Something went wrong!');
	            $('.md-content p').html('Please try again.');
	          }
	        }
	      });
	      return false;
	  });

	  // hide messages 
	  $(".error").hide();
	  $(".success").hide();
	  
	  $('#contactForm input').on('click', function(){
	        $(".error").fadeOut();
	        return false;
	    });
	  
	  // on submit...
	  $("#contactForm #submit").on('click', function(){
	    $(".error").hide();
	    
	    //required:
	    
	    //name
	    var name = $("input#name").val();
	    if(name == ""){
	      //$("#error").fadeIn().text("Name required.");
	      $('#fname').fadeIn('slow');
	      $("input#name").focus();
	      return false;
	    }
	    
	    //email (check if entered anything)
	    var email = $("input#email").val();
	    //email (check if entered anything)
	    if(email == ""){
	      //$("#error").fadeIn().text("Email required");
	      $('#fmail').fadeIn('slow');
	      $("input#email").focus();
	      return false;
	    }
	    
	    //email (check if email entered is valid)

	    if (email !== "") {  // If something was entered
	      if (!isValidEmailAddress(email)) {
	        $('#fmail').fadeIn('slow'); //error message
	        $("input#email").focus();   //focus on email field
	        return false;  
	      }
	    } 

	    function isValidEmailAddress(emailAddress) {
	        var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
	        return pattern.test(emailAddress);
	    };

	    
	    
	    
	    // comments
	    var comments = $("#msg").val();
	    
	    if(comments == ""){
	      //$("#error").fadeIn().text("Email required");
	      $('#fmsg').fadeIn('slow');
	      $("input#msg").focus();
	      return false;
	    }

	    
	  });  
	    
	    
	  // on success...
	   function success(){
	    $("#success").fadeIn();
	    $("#contactForm").fadeOut();
	   }
	  
	    return false;
	});
});

