var current_editable_row = '';
jQuery(document).ready( function ($) {
    $('#question-two-form-data').DataTable();
    $('#question-three-form-data').DataTable();    
    var four_form_dt = $('#question-four-form-data').DataTable({
        "processing":true,
	"ajax":{
            url:m2sys_admin_url+"admin-ajax.php",
            type:"POST",
            data:{
                action: "m2sys_admin_ajax",
                purpose:'qfdtd'
            },
            dataType:"json"
	},
        columns:[
            {data:'sl'},            
            {data:'name'},            
            {data:'email'},            
            {data:'phone'},            
            {data:'gender'},            
            {data:'address'},            
            {data:'action_button'}
        ]
    });
    
    
    $("#new_data_create_button").click(function(){
        $.ajax({
            type:"POST",
            url:m2sys_admin_url+"admin-ajax.php",
            data : {
              action: "m2sys_admin_ajax",
              purpose:'gqfif'
            },
            success: function(res){
                bootstrap_modal_init({
                    title:'Popup Title',
                    content:res,
                    close_button:false,
                    bottom_buttons:[]
                });
                $("#bootstrap_modal_").modal('toggle');
            },
            error: function(err) {}
        });
    })
    
    var form_pause = false;
    $(document).on('submit','#question_four_form',function(e){
        e.preventDefault();
        var validate = requre_validation(['name','email','phone','address','gender']) && 
		email_validation(['email']) && 
		phone_no_validation(['phone']);
        
        if(!form_pause && validate){
           form_pause = true;
            var $this = $(this);
            $this.find(".loader").html("<img src='"+m2sys_plugin_url+"/images/loader1.jpg' style='position:absolute;top:0;max-width:40px'/>");

            var data = new FormData($this[0]);
            data.append( 'action', 'm2sys_admin_ajax');
            data.append( 'purpose', 'sqffd');
                        
            $.ajax({
                type:"POST",
                url:m2sys_admin_url+"admin-ajax.php",
                data : data,
                processData: false,
	        contentType: false,
                success: function(res){   
                    form_pause = false;
                    $this.find(".loader").html("");
                    $this[0].reset();
                    $("#bootstrap_modal_").modal('hide');
                    
                    var submitted_data = '';
                    try{
                        submitted_data = JSON.parse(res);
                    }catch(e){}    
                    
                    after_action(submitted_data||{});                    
                },
                error: function(err) {
                    form_pause = false;
                    $this.find(".loader").html("");
                    
                }
            });
        }
    })
    $('#question-four-form-data tbody').on('click','.q4_data_edit',function(e){        
        var $this = $(this);
        current_editable_row = $this.closest('tr');
        $.ajax({
            type:"POST",
            url:m2sys_admin_url+"admin-ajax.php",
            data : {
              action: "m2sys_admin_ajax",
              purpose:'gqfif',
              data_id:$this.attr('data-id')
            },
            success: function(res){                
                bootstrap_modal_init({
                    title:'Popup Title',
                    content:res,
                    close_button:false,
                    bottom_buttons:[]
                });
                $("#bootstrap_modal_").modal('toggle');
            },
            error: function(err) {}
        });
    });
    $('#question-four-form-data tbody').on('click','.q4_data_delete',function(e){        
        if(!confirm('Are you sure to delete data?')){
            return;
        }        
        var $this = $(this);        
        $.ajax({
            type:"POST",
            url:m2sys_admin_url+"admin-ajax.php",
            data : {
              action: "m2sys_admin_ajax",
              purpose:'qfdd',
              data_id:$this.attr('data-id')
            },
            success: function(res){ 
                if(res=='success'){
                    alert("Data deleted successfully");
                    four_form_dt.ajax.reload( null, false );
                }else{
                    alert("Something wrong! Please try again later.");
                }
            },
            error: function(err) {}
        });
    });
    
    function after_action(data){
        var s = false;
        
        if(typeof data === 'object'){
            if(data.action == 'insert'){
               //tr_data = [parseInt($('#question-four-form-data tbody tr').not($('.dataTables_empty').closest('tr')).length)+1].concat(data.data);
                //four_form_dt.row.add(tr_data).draw();   
                four_form_dt.ajax.reload( null, false );
            }else if(data.action == 'update'){                   
                var td = current_editable_row.find('td:first-child').prop('outerHTML');
                if(Array.isArray(data.data)){
                    data.data.forEach(function(d){
                        td += "<td>"+d+"</td>";
                    })
                }
                td += current_editable_row.find('td:last-child').prop('outerHTML');
                
                current_editable_row.html(td);
                current_editable_row = '';
            }                
            s= true;
        }
        setTimeout(function(){    
            if(s){
                alert("Information received successfully");
            }else{
                
                alert("Something wrong! Please try again later.");
            }
        },500);
    }
    
} );


function bootstrap_modal_init(data){
    data = data||{};
    var modal_footer = '';
    var bottom_buttons = '';
    var close_button = '';
    
    if(data.bottom_buttons && Array.isArray(data.bottom_buttons)){
        data.bottom_buttons.forEach(function(el){
            bottom_buttons += el;
        })
    }    
    if(data.close_button){        
        close_button = "<button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>";
    }    
    if(bottom_buttons || close_button){
        modal_footer = `<div class='modal-footer'>${bottom_buttons}${close_button}</div>`;
    }
    if(document.querySelector("#bootstrap_modal_")){
      document.querySelector("#bootstrap_modal_").outerHTML = '';
    }
   document.querySelector('body').insertAdjacentHTML(
      'beforeend', 
        `<div class='modal fade' id='bootstrap_modal_' data-bs-backdrop='static' data-bs-keyboard='false' tabindex='-1' aria-labelledby='staticBackdropLabel' aria-hidden='true'>
         <div class='modal-dialog'>
           <div class='modal-content'>
             <div class='modal-header'>
               <h5 class='modal-title' id='staticBackdropLabel'>${data.title||''}</h5>
               <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
             </div>
             <div class='modal-body'>
               ${data.content||''}
             </div>
             ${modal_footer}
           </div>
         </div>
       </div>`
  );
}


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




