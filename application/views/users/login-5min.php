
<script type="text/javascript">
var Login=function(){
var r=function(){
$(".login-form").validate({
   errorElement:"span",errorClass:"help-block",focusInvalid:!1,rules:{username:{required:!0},password:{required:!0},remember:{required:!1}},messages:{username:{required:"Username is required."},password:{required:"Password is required."}},invalidHandler:function(r,e){$(".alert-danger",$(".login-form")).show()},highlight:function(r){$(r).closest(".form-group").addClass("has-error")},
   success:function(r){r.closest(".form-group").removeClass("has-error"),r.remove()},errorPlacement:function(r,e){r.insertAfter(e.closest(".input-icon"))},
   submitHandler:function(r){
	   
           var url =$("#url").val();
	       var email =$("#email").val();
	       var password =$("#password").val();
	
	        $.ajax({
			type: "POST",				
			data: {	
              email: email,			  
              password: password,
			},		
			    url: url + "login/validatelogin",												
				success: function(data){				
				       if ($.trim(data)=="Success")
						{
						   window.location=url	;
						}else{
							
							$('#errlog').text(data);							  	
							$('#errlog').show();							  	
					    }                
				} 
		 		
	 	});
      
   }}),$(".login-form input").keypress(function(r){return 13==r.which?($(".login-form").validate().form()&&$(".login-form").submit(),!1):void 0}),$(".forget-form input").keypress(function(r){return 13==r.which?($(".forget-form").validate().form()&&$(".forget-form").submit(),!1):void 0}),$("#forget-password").click(function(){$(".login-form").hide(),$(".forget-form").show()}),$("#back-btn").click(function(){$(".login-form").show(),$(".forget-form").hide()})};return{init:function(){r(),$(".login-bg").backstretch(["<?php echo base_url(); ?>assets/pages/img/login/bg.jpg","<?php echo base_url(); ?>assets/pages/img/login/bg.jpg","<?php echo base_url(); ?>assets/pages/img/login/bg.jpg"],{fade:1e3,duration:8e3}),$(".forget-form").hide()}}}();jQuery(document).ready(function(){Login.init()});
   
 </script>
 