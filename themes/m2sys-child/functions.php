<?php

/**
 * Create a landing page when activate child theme.
 */
add_action('after_switch_theme', function() {
    $contentPage = '';
    if ($page = __DIR__ . '/' . 'm2sys-landing-page.content') {
        $contentPage = file_get_contents($page);
    }
    $page_slug = 'm2sys-landing-page';
    $new_page = array(
        'post_type' => 'page',
        'post_title' => 'Landing Page',
        'post_content' => htmlspecialchars(str_replace("'", "|_|", $contentPage)),
        'post_status' => 'publish',
        'post_author' => 1,
        'post_name' => $page_slug
    );
    if (!get_page_by_path($page_slug, OBJECT, 'page')) { // Check If Page Not Exits
        $new_page_id = wp_insert_post($new_page);
    }
    if ($new_page_id) {
        update_post_meta($new_page_id, '_wp_page_template', 'landing-page-template.php');
        update_option( 'page_on_front', $new_page_id );
        update_option( 'show_on_front', 'page' );
    }
});

/**
 * Delete automatically created landing page
 */
add_action('switch_theme', function() {
    global $wpdb;
    $post_id = $wpdb->get_var($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type='page' AND post_status='publish' ", 'm2sys-landing-page'));
    if ($post_id) {
        wp_delete_post($post_id);
    }
});

/**
 * Append child theme css & js files into website
 */
add_action('wp_enqueue_scripts', function() {
    if (get_page_template_slug() == 'landing-page-template.php') {
        wp_enqueue_style('m2sys-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
//    wp_enqueue_style('m2sys-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC');
        wp_enqueue_style('m2sys-custom-css', get_stylesheet_directory_uri() . '/assets/css/custom.css.css');
//
//    wp_enqueue_script('m2sys-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
//    wp_enqueue_script('m2sys-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js');
//    
//    
//    
    }

    wp_enqueue_style('sydny-css', get_template_directory_uri() . '/style.css');
});

/**
 * Append child theme css & js files into admin panel
 */
add_action('admin_enqueue_scripts', function() {
    
    if(!isset($_GET['page']) || $_GET['page']!='front-page-edit') return;
    
    wp_enqueue_style('m2sys-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('m2sys-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC');
    wp_enqueue_style('m2sys-custom-css', get_stylesheet_directory_uri() . '/assets/css/custom.css.css');

    wp_enqueue_script('m2sys-jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    wp_enqueue_script('m2sys-bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js');





    wp_enqueue_style('sydny-css', get_template_directory_uri() . '/style.css');
});



/**
 * Create a menu page using short code
 */
add_shortcode('m2sys_template_menu', function() {
    require_once __DIR__ . '/inc/menu.php';
});


add_action('admin_menu', function() {
    add_menu_page('Front Page Edit', 'Front Page', 'manage_options', 'front-page-edit', function() {
        echo "<div class='wrap' >";


        if (isset($_POST['save_change'])) {
            if (wp_update_post(
                            array(
                                'ID' => $_POST['page_id'],
                                'post_content' => sanitize_textarea_field(htmlspecialchars(str_replace("'", "|_|", $_POST['page_content'])))
                            )
                    )
            ) {
                update_post_meta($_POST['page_id'], "m2sys_landing_page_contact_form", sanitize_text_field($_POST['form_short_code']));

                echo '<div class="alert alert-success  alert-dismissible fade show" role="alert">
                        Changed saved successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        Something Wrong. Please Try Again.
                      </div>';
            }
        } else if (isset($_POST['reset'])) {
            $contentPage = '';
            if ($page = __DIR__ . '/' . 'm2sys-landing-page.content') {
                $contentPage = file_get_contents($page);
            }
            if (wp_update_post(
                            array(
                                'ID' => $_POST['page_id'],
                                'post_content' => sanitize_textarea_field(htmlspecialchars(str_replace("'", "|_|", $contentPage)))
                            )
                    )
            ) {
                echo '<div class="alert alert-success  alert-dismissible fade show" role="alert">
                        Reset successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                        Something Wrong. Please Try Again.
                      </div>';
            }
        }

        global $wpdb;
        $landing_page = $wpdb->get_row($wpdb->prepare("SELECT * FROM $wpdb->posts WHERE post_name = %s AND post_type='page' AND post_status='publish' ", 'm2sys-landing-page'));



        if (!$landing_page)
            return;

        $page_form = get_post_meta($landing_page->ID, "m2sys_landing_page_contact_form", true);

        /*
          $contentPage = '';
          if ($page = __DIR__ . '/' . 'm2sys-landing-page.content') {
          $contentPage = file_get_contents($page);
          }
          $content = htmlspecialchars_decode(str_replace("|_|", "'", $contentPage));
         */
        $content = htmlspecialchars_decode(str_replace("|_|", "'", $landing_page->post_content));

        echo "<div class='page-content  border' contenteditable>
        $content
        </div>
        <div class='my-5'>
            <form method='post' action='#'>
                <input type='hidden' name='page_id' value='$landing_page->ID'/>
                <textarea name='page_content' class='d-none'></textarea>
                <div class='mb-3 mt-3'>
                <label class='form-label'>Enter Form Short Code</label>
                <input type='text'  name='form_short_code' value='$page_form' class='form-control' placeholder='[contact-form-7 id=\"1\" title=\"Contact form 1\"]'>
              </div>
               <button class='btn btn-primary' name='save_change'>Save Changed</button>
               <button class='btn btn-info text-white' name='reset'>Reset</button>
            </form>
         </div>
       ";
        ?>
        <style>
            .append-html{
                display: none
            }
        </style>
        <script>
            document.querySelector("[name='save_change']").addEventListener('click', function () {
                document.querySelector("[name='page_content']").innerHTML = document.querySelector(".page-content").innerHTML;
            })
        </script>
        <?php

        echo "</div>";
    });
});
