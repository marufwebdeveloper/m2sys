jQuery(document).ready(function($){
	var form_pause = false;
	$("#question_two_form").submit(function(e){
		e.preventDefault();

		var validate = requre_validation(['name','email','phone','address','gender']) && 
		email_validation(['email']) && 
		phone_no_validation(['phone']);

		if(!form_pause && validate){
			form_pause = true;

			var $this = $(this);

			$this.find(".loader").html("<img src='"+m2sys_plugin_url+"/images/loader1.jpg' style='position:absolute;top:0;max-width:40px'/>");

			var data = new FormData($this[0]);
			data.append( 'action', 'm2sys_ajax');
			data.append( 'purpose', 'sqtfd');

			$.ajax({
	          type:"POST",
	          url:m2sys_site_url+"/wp-admin/admin-ajax.php",
	          data :data,
	          processData: false,
	          contentType: false,
	          success: function(res){
	          	form_pause = false;
	          	$this.find(".loader").html("");
	          	$this[0].reset();
	          	if(res=='success'){
	          		$("#form-submit-message").html("<p class='text-success'>Information received successfully</p>");
	          	}else{
	          		$("#form-submit-message").html("<p class='text-danger'>Something wrong! Please try again later.</p>");
	          	}
	          	setTimeout(function(){
	          		$("#form-submit-message").html("");
	          	},3000);
	          },
	          error: function(err) {
	          	form_pause = false;
	          	$this.find(".loader").html("");
	          }
	        });
		}

	})
});


function requre_validation($fields){
	var s = true;
	$fields.forEach(function($f){
		var field = document.querySelector("[name='"+$f+"']");
		if(!field.value){
			s = false;
			field.classList.add('border','border-danger');
		}else{
			field.classList.remove('border','border-danger');
		}
	});
	return s;
}

function email_validation($fields){
	var s = true;
	$fields.forEach(function($f){
		var field = document.querySelector("[name='"+$f+"']");
		var re = /\S+@\S+\.\S+/;
		if(!re.test(field.value)){
			s = false;
			field.classList.add('border','border-danger');
		}else{
			field.classList.remove('border','border-danger');
		}
	});
	return s;
}

function phone_no_validation($fields){
	var s = true;
	$fields.forEach(function($f){
		var field = document.querySelector("[name='"+$f+"']");

		var re = /^[0]\d{0}[1]\d{0}[0-9]\d{8}$/;
		if(!re.test(field.value)){
			s = false;
			field.classList.add('border','border-danger');
		}else{
			field.classList.remove('border','border-danger');
		}
	});
	return s;
}


