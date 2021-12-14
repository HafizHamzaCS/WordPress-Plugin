
//========================================================================
// Hide and show forms on the event of previous and next in multistep form 
//========================================================================
//========================================================================
//=============validate first section of the form      ===================
//========================================================================
jQuery(document).ready(function(){
	jQuery("#first_next").click(function(){
		var email		= jQuery('#email').val();
		var password 	= jQuery('#password').val();
		var cpassword 	= jQuery('#cpassword').val();
		if (email == '' || password == '' || cpassword == '') {
		alert("All Fields are required");
		} else if ((password.length) < 8) {
		alert("Password should atleast 8 character in length");
		} else if (!(password).match(cpassword)) {
		alert("Your passwords don't match. Try again");
		} 
		else
		{
			jQuery(this).parents(".form-box").fadeOut('fast');
			jQuery(this).parents(".form-box").next().fadeIn('fast');	
		}
	});
});
//===========================================================================
//=============validate second section of the form      =====================
//===========================================================================
jQuery(document).ready(function(){	
	jQuery("#second_next").click(function(){
		var FirstName 		= jQuery('#FirstName').val();
		var LastName 		= jQuery('#LastName').val();
		var phone_no 		= jQuery('#phone_no').val();
		var inputAddress1 	= jQuery('#inputAddress1').val();
		var inputAddress2 	= jQuery('#inputAddress2').val();
		var inputcountry 	= jQuery('#inputcountry').val();
		var post_code 		= jQuery('#post_code').val();
		if (FirstName == '' || LastName == '' || phone_no == '' || inputAddress1 == '' || inputAddress2 == '' || post_code == '') 
		{
			alert('All fields are required');
			return false;
		}
		else
		{
			jQuery('#FirstName,#LastName,#phone_no,#inputAddress1,#inputAddress2,#inputCity,#inputState,#post_code').css({"background-color": "" , "border": "#43EF9C"});
			//jQuery('#first_next').attr('disabled',true);
			jQuery(this).parents(".form-box").fadeOut('fast');
			jQuery(this).parents(".form-box").next().fadeIn('fast');
			
		}
	});
});	

//===============================================================================
//=============show form on previous button            ==========================
//===============================================================================
jQuery(document).ready(function(){	
	jQuery(".multistep-container .multistep-form-area .form-box .button-row .previous").click(function(){

		jQuery(this).parents(".form-box").fadeOut('fast');
		jQuery(this).parents(".form-box").prev().fadeIn('fast');
	});
});	
//===============================================================================================
// Hide and show fields on the base of medical and other in medical type fields on multistep form
//==============================================================================================
jQuery(document).ready(function(){	
	jQuery('#medical_type').on('change', function(){
	    if ( this.value == 'medical')
	    {
	      jQuery(".medical_form_show").show();
	    }
	    else
	    {
	      jQuery(".medical_form_show").hide();
	    }
    });
}); 

//=====================================================================================================
// Hide and show fields on the base of prescriber and non prescriber in prescriber field multistep form
//=====================================================================================================
jQuery(document).ready(function(){	
	jQuery('#PrescriberType').on('change', function(){
	    if ( this.value == 'prescriber')
	    {
	      jQuery(".four_digit_password").show();
	    }
	    else
	    {
	      jQuery(".four_digit_password").hide();
	    }
    });
});
//===============================================================================
//=============validate third section of the form      ==========================
//===============================================================================
//===============================================================================
// refine pharma custom form data handle 
//===============================================================================
jQuery(document).ready(function(){
	jQuery('#refine_form').submit(function(e){
		   e.preventDefault();  
		   var form = new FormData(jQuery('#refine_form')[0]);
		        form.append('action', 'refine_form_function');
		        jQuery.ajax({
		            //url: refine_object.ajax_url,
		            url: wc_add_to_cart_params.ajax_url,
		            data: form,
		            processData: false,
		            contentType: false,
		            type: 'post',
		            success: function(response) {
		                alert(response);
		                 console.log('Ajax is workings');
		            }
		        });
	    	//}
	});
});
//===============================================================================
//============= loader function on submit button ===== ==========================
//===============================================================================
jQuery(document).ready(function () {
    jQuery(document).ajaxStart(function () {
        jQuery("#ajaxSpinnerImage").show();
		jQuery(".submit_refine").attr("disabled", true);
		//alert('form already submitted');

    })
    jQuery(document).ajaxStop(function () {
        jQuery("#ajaxSpinnerImage").hide();
       // alert('form submitted successfull');
        jQuery(".submit_refine").attr("disabled",false);
    });

})
//===============================================================================
//============= validation of data on 3rd section on submit button=================
//===============================================================================
//    var pass_1 				= jQuery('#pass_1').val();
// var pass_2 				= jQuery('#pass_2').val();
// var pass_3 				= jQuery('#pass_3').val();
// var pass_4	 			= jQuery('#pass_4').val();
// var upload_id 			= jQuery('#upload_id').val();
// var upload_certificate 	= jQuery('#upload_certificate').val();
// var inputcountry 		= jQuery('#inputcountry').val();
//   if (pass_1 == '' || pass_2 == '' || pass_3 == '' || pass_4 == '' || upload_id == '' || upload_certificate == ''|| inputcountry =='') 
//   {
//   	alert('Please fill the required fields');
//   }
//   else
//   {
//===============================================================================
//==hide and show registration form and log in form on my account page ==========
//===============================================================================
jQuery(document).ready(function () {
	jQuery('#hide_form_jquery').hide();
	jQuery('#register_button_refine').on('click',function(){
		jQuery('#hide_form_jquery').show();
		jQuery('#login_refine').hide();
	})
});
//===============================================================================
//=============send data through ajax of patient form  ==========================
//===============================================================================
jQuery(document).ready(function() {
    jQuery('#patient-form').submit(function(event) {
        event.preventDefault();
        var form = new FormData(jQuery('#patient-form')[0]);
        form.append("action", 'patient_form_data');
        jQuery.ajax({
            url: wc_add_to_cart_params.ajax_url,
            data: form,
            type: 'post',
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response);
                console.log('patient form is submiting');
            }
        });
    });
});
