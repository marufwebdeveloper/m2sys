var page_n_snippet_data = {};

function do_if(selector,callback,selector_type){
	selector_type = selector_type||'';
	var selector_obj;

	if(selector_type===true){
		selector_obj = document.querySelectorAll(selector);
	}else{
		selector_obj = document.querySelector(selector);
	}
	if(selector_obj){
		callback(selector_obj);
	}
	
}

jQuery(document).ready(function($){
	$("#moksy_pb_form").submit(function(e){
		e.preventDefault();
		console.log(e.target);
		$.ajax({
      type:"POST",
      url:moksy_admin_url+"admin-ajax.php",
      data : {
      	action: "moksy_ajax"
      },
      success: function(res){
      	console.log(res);

      },
      error: function(err) {

      }
    });
	});
	$(".snippet-add-table tbody").on('click','.add-snippet-content',function(){
		var snippet_info = $(this).closest('tr').attr('data')||{};

		try{
			snippet_info = JSON.parse(snippet_info);

		}catch(e){}	


		c_modal(
			'show',
			{
				title:snippet_info.title,
				content:'<h4>Loading...</h4>'
			}
		);

		$.ajax({
      type:"POST",
      url:moksy_admin_url+"admin-ajax.php",
      data : {
      	action: "moksy_ajax",
      	purpose:'get_snippet_page',
      	snippet: snippet_info.value
      },
      success: function(res){
      	var modal_data = '';

      	modal_data = "<div class='row mt-5'><div class='col'><button class='btn btn-info'>Save</button></div></div>";


      	$("#c_Modal_ .c_modal-body").html(modal_data);




      	console.log(res);



      },
      error: function(err) {}
    });


		
	})
})

window.onload = function(){
	do_if("#add_moksy_snippet",function(s){
		s.addEventListener('change',function(){
			var snippet_info = selected_snippet_info(this.value);
			var table = document.querySelector('.snippet-add-table tbody');
			var row_length = table.rows.length;
			var new_row = table.insertRow(row_length);
			new_row.setAttribute("index",row_length);
			new_row.setAttribute("data",JSON.stringify(snippet_info));

			new_row.innerHTML = snippet_row(
				snippet_info,
				row_length
			);
			this.value='';
		})
	});
}




function move_up($this){
	var index = $this.closest('tr').getAttribute('index');
	if(index>0)
	tr_move_up_down(index,'up');
}
function move_down($this){
	var index = $this.closest('tr').getAttribute('index');
	if(index<parseInt($this.closest('tbody').rows.length)-1)
	tr_move_up_down(index,'down');
}

function tr_move_up_down(index,type){
	var table = document.querySelector('.snippet-add-table tbody');
	var target_tr = table.querySelector('tr[index="'+index+'"]');
	var target_tr_content = target_tr.outerHTML;
	target_tr.outerHTML = '';

	if(type=='up'){
		table.querySelector('tr[index="'+parseInt(index-1)+'"]').insertAdjacentHTML('beforebegin',target_tr_content);
	}else if(type=='down'){
		table.querySelector('tr[index="'+(parseInt(index)+1)+'"]').insertAdjacentHTML('afterend',target_tr_content);
	}
	do_if(".snippet-add-table tbody tr",function(s2){
		s2.forEach(function(el,i){
			el.setAttribute('index',i);
		})
	},true);
}

function delete_snippet($this){
	$this.closest('tr').outerHTML = '';
}
/*function add_snippet_content($this){
	var snippet_info = $this.closest('tr').getAttribute('data');

		try{
			snippet_info = JSON.parse(snippet_info);

		}catch(e){}		
		prepare_popup(snippet_info.title||'','<b>Hello</b>');
		modal_show_hide('show');
}*/
function selected_snippet_info(selected_snippet){
	var data = {};
	do_if("#moksy_snippets option",function(s2){
		s2.forEach(function(el){
			if(selected_snippet.trim() == el.text.trim()){
				data = {
					'title':el.text,
					'value':el.getAttribute('data-value')
				};
				return false;
			}
		})
	},true);
	return data;
}
function snippet_row(data){

	var tr = `
		<td class='snipet_title'>${data.title}</td>
		<td>
			<p class='snippet-btn add-snippet-content'>Add Content</p>
			<p class='snippet-btn' title='Remove Snippet' onclick='delete_snippet(this)'><span class="dashicons dashicons-trash"></span></p>
			<p class='snippet-btn' title='Move to Top' onclick='move_up(this)'>&#129093;</p>
			<p class='snippet-btn' title='Move to Down' onclick='move_down(this)'>&#129095;</p>
			
		</td>		
	`;
	return tr;
}




/*------------------MODAL-------------------------*/
function prepare_popup(title,content){
	do_if("#c_Modal_",function(s){
		s.outerHTML = '';
	})
    document.querySelector('body').insertAdjacentHTML(
      'beforeend',
      `<div id="c_Modal_" class="c_modal">
          <div class="c_modal-content">
            <div class='c_modal-header'>
                <h4 class='c_modal-title'>${title}</h4>
                <span class="close" onclick='popup_close()'>&times;</span>
            </div>

            <div class='c_modal-body'>
              ${content}
            </div>
          </div>
        </div>`
    ); 	
  }
    
  
  function c_modal(type,data){
  	if(type=='show'){
  		prepare_popup(data.title||'',data.content||'');
  		document.getElementById("c_Modal_").style.display = "block";
  	}
    if(type=='hide')document.getElementById("c_Modal_").outerHTML = "";    
  }  
  function popup_close() {
    c_modal('hide');
  }  
  window.onclick = function(event) {
    var modal = document.getElementById("c_Modal_");
    if (event.target == modal) {
      c_modal('hide');
    }
  }

