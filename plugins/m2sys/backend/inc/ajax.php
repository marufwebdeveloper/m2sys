<?php

//sqffd = store question four form data
// gqfif = get question four input form
// qfdtd = question 4 data table data



if (isset($_POST['purpose'])) {
    if ($_POST['purpose'] == 'sqffd') {
        if (check_ajax_referer('m2sys_question_four_form_nonce')) {
            $content = [
                'name' => sanitize_text_field($_POST['name']),
                'email' => sanitize_email($_POST['email']),
                'phone' => sanitize_text_field($_POST['phone']),
                'gender' => sanitize_text_field($_POST['gender']),
                'address' => sanitize_textarea_field($_POST['address'])                
            ];
            $input_data = array(
                'post_type' => 'question_four_data',
                'post_title' => 'm2sys-question-four-form-data',
                'post_content' => json_encode($content),
                'post_status' => 'publish',
                'comment_status' => 'closed',
                'ping_status' => 'closed',
            );
            $data = array_values($content);

            if (isset($_POST['data_id'])) {
                $input_data['ID'] = $_POST['data_id'];

                if (wp_update_post($input_data))
                    echo json_encode(['data'=>$data,'action'=>'update']);
            }else {
                if ($id = wp_insert_post($input_data)) {
                    array_push(
                            $data, "
                        <div>
                            <button class='btn q4_data_edit' data-id='$id'>Edit</button>                                                    
                            <button class='btn q4_data_delete' data-id='$id'>Delete</button>
                        </div>
                    "
                    );
                    echo json_encode(['data'=>$data,'action'=>'insert']);
                }
            }
        }
    } else if ($_POST['purpose'] == 'gqfif') {
   
        $data = [];
        $data_id = isset($_POST['data_id']) ? $_POST['data_id'] : '';
        $submit_button = '';
        if ($data_id) {
            $get_post = get_post($data_id);
            if (isset($get_post->post_content)) {
                $data = json_decode($get_post->post_content, true);
                $data = is_array($data) ? $data : [];
            }
            $submit_button = "<button type='submit' class='btn btn-primary' style='width: 200px;position: relative;'>Update <span class='loader'></span></button>";
        } else {
            $submit_button = "<button type='submit' class='btn btn-primary' style='width: 200px;position: relative;'>Submit <span class='loader'></span></button>";
        }
        $gender = '';
        foreach (['Male', 'Female'] as $g) {
            $selected = value($data, 'gender') == $g ? 'selected' : '';
            $gender .= "<option value='$g' $selected>$g</option>";
        }

        $html_form = "<form action='#' method='post' id='question_four_form'>
            " . wp_nonce_field('m2sys_question_four_form_nonce') . ($data_id ? "<input type='hidden' name='data_id' value='$data_id'/>" : '') . "
            <div class='mb-3'>
              <label for='name' class='form-label'>Name</label>
              <input type='name' name='name' value='" . value($data, 'name') . "' class='form-control' id='name' aria-describedby='emailHelp' placeholder='Enter Name'>
            </div>
            <div class='mb-3'>
              <label for='email' class='form-label'>Email</label>
              <input type='email' name='email' value='" . value($data, 'email') . "' class='form-control' id='email' placeholder='Enter Email Address'>
            </div>
            <div class='mb-3'>
              <label for='phone' class='form-label'>Phone</label>
              <input type='text' name='phone' value='" . value($data, 'phone') . "' class='form-control' id='phone' placeholder='Enter Phone'>
            </div>
            <div class='mb-3'>
              <label for='address' class='form-label'>Address</label>
              <textarea name='address' class='form-control' id='address' placeholder='Enter Your Address'>" . value($data, 'address') . "</textarea>
            </div>
            <div class='mb-3'>
              <label for='gender' class='form-label'>Gender</label>
              <select name='gender'  class='form-select' id='gender' style='max-width:100%'>
                  <option value=''>Select Gender</option>
                  $gender        
              </select>
            </div>
            $submit_button
          </form>";

        echo $html_form;
     } else if ($_POST['purpose'] == 'qfdd') {
         if (isset($_POST['data_id'])) {
            if(wp_delete_post($_POST['data_id'])){
                echo 'success';
            }
         }
     } else if ($_POST['purpose'] == 'qfdtd') {
         
            $question_four_form_data = get_posts(array(
                'numberposts' => -1,
                'post_type' => 'question_four_data',
                'orderby' => 'publish_date',
                'order' => 'DESC'
            ));
            $json_data = ['data'=>[]];
            foreach ($question_four_form_data as $key => $data) {
                $user_data = json_decode($data->post_content, true);
                $json_data['data'][] = [
                    'sl'=> ++$key,
                    'name'=> $user_data['name'],
                    'email'=> $user_data['email'],
                    'phone'=> $user_data['phone'],
                    'gender'=> $user_data['gender'],        
                    'address'=> $user_data['address'],
                    'action_button' => "<div>
                                            <button class='btn q4_data_edit' data-id='$data->ID'>Edit</button>                                                    
                                            <button class='btn q4_data_delete' data-id='$data->ID'>Delete</button>
                                        </div>"
                ];                    
            }
            echo (json_encode($json_data));
     }
}

function value($array, $key) {
    if (is_array($array) && isset($array[$key]))
        return $array[$key];
}
