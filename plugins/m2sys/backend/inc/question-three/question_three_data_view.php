<?php
$response = wp_remote_get('https://gorest.co.in/public/v2/users');
if (!is_wp_error($response)) {
    $response = json_decode($response['body'], true);
    ?>
    <div class="wrap">
        <table class="table table-bordered table-striped" id="question-three-form-data">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Status</th>			
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($response as $key => $val) {
                    echo "<tr>
                        <td>" . ++$key . "</td>
                        <td>$val[name]</td>
                        <td>$val[email]</td>
                        <td>$val[gender]</td>
                        <td>$val[status]</td>				
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>
    </div>

<?php } ?>