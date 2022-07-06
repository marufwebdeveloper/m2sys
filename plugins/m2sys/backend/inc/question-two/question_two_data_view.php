<?php
$question_two_form_data = get_posts(array(
    'numberposts' => -1,
    'post_type' => 'question_two_data',
    'orderby' => 'publish_date',
    'order' => 'DESC'
        ));
?>
<div class="wrap">
    <table class="table table-bordered table-striped" id="question-two-form-data">
        <thead>
            <tr>
                <th>SL</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Gender</th>
                <th>Address</th>			
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($question_two_form_data as $key => $data) {
                $user_data = json_decode($data->post_content, true);
                echo "<tr>
						<td>" . ++$key . "</td>
						<td>$user_data[name]</td>
						<td>$user_data[email]</td>
						<td>$user_data[phone]</td>
						<td>$user_data[gender]</td>
						<td>$user_data[address]</td>				
					</tr>
					";
            }
            ?>
        </tbody>
    </table>
</div>