<?php 

	//$dd = htmlspecialchars();

	//echo htmlspecialchars_decode($dd);

	/*$myfile = fopen('F:\xampp-7_1_4\htdocs\gglink\moksy/wp-content/themes/moksy-child/template-parts/snippets/project/gglink/aboutus-banner.php', "r") or die("Unable to open file!");
	// Output one line until end-of-file
	while(!feof($myfile)) {
	  $dd = htmlspecialchars(fgets($myfile));
	}
	fclose($myfile);*/
	
?>

<div class="wrap">
	<h3>Create Page Content</h3>
	<hr/>
	<form action="#" method="post" id="moksy_pb_form">
		<div class="form-group">
			<label>Pages</label>
			<select class="form-control" required="">
				<option value="">Select Pages</option>
				<?php  
				foreach(get_pages() as $page){
					echo "<option value='$page->ID'>$page->post_title</option>";
				}
				?>
			</select>
		</div>
		<div class="form-group">
			<label>Add Snippet</label>
			<table class="table table-bordered snippet-add-table">
				<thead>
					<tr>
						<th>Snippet Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody></tbody>
				<tfoot>
					<tr>
						<td colspan="2">
							<input list="moksy_snippets" class="form-control" placeholder="Select Snippets" id="add_moksy_snippet">
							<datalist id="moksy_snippets">
								<?php  
								if(function_exists('moksy_snippets')){
									foreach(moksy_snippets() as $title=>$file){
										echo "<option data-value='$title'>".str_replace('_',' ',$title)."</option>";
									}
								}			
								?>
							</datalist>
						</td>
					</tr>
				</tfoot>
			</table>		
		</div>
		
		<div class="form-group mt-5">
			<button class="btn btn-primary" name="save">Save</button>
			<button class="btn btn-success" name="save_n_preview">Save & Preview</button>		
		</div>
	</form>
	
</div>