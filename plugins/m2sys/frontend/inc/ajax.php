<?php

//sqtfd = store question two form data

if (!check_ajax_referer( 'm2sys_form_nonce' )){
  wp_die();
} 

if(isset($_POST['purpose'])){
  if($_POST['purpose']=='sqtfd'){
    if(wp_insert_post( array(
      'post_type' => 'question_two_data',
      'post_title'    => 'm2sys-question-form-data',
      'post_content'  => json_encode([
        'name' => sanitize_text_field($_POST['name']),
        'email' => sanitize_email($_POST['email']),
        'phone' => sanitize_text_field($_POST['phone']),
        'address' => sanitize_textarea_field($_POST['address']),
        'gender' => sanitize_text_field($_POST['gender'])
        
      ]),
      'post_status'   => 'publish',
      'comment_status' => 'closed',
      'ping_status' => 'closed', 
    ))){
      echo 'success';
    }
  }
}