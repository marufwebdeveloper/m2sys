<?php 


if(isset($_POST['purpose'])){
	if($_POST['purpose']=='get_snippet_page'){
		if(function_exists('moksy_snippets')){
			echo moksy_snippets($_POST['snippet']);
		}
	}
}