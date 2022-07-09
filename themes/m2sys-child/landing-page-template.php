<?php
/**
 * Template Name: M2sys Landing Page
 *
 * @package 
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

        <?php wp_head(); ?>

        <style>
            .main-header, .header-search-form{
                background: none !important;
            }
            .menu-toggle{
                color: white
            }
            a.menu-toggle:hover,a.menu-toggle:focus,a.menu-toggle:active {
                color: #ccc
            }
            .sydney-offcanvas-menu.toggled,.footer-widgets,#colophon {
                background-color: #18496a !important;
            }
            .btn{
                font-size: 15px !important;
            }
            button.accordion-button {
                font-family: arial;
                font-size: 12px;
            }
            p.h4{
                font-size: 22px
            }
            b.h5{
                font-size: 18px
            }
            h2.accordion-header {
                margin: 0;
                font-weight: 500
            }
            input[type='text'],
            input[type='password'],
            input[type='email']{
                height: 35px !important;
            }
        </style>
    </head>

    <body <?php body_class(); ?>>

        <?php while (have_posts()) : the_post(); ?>
            <?php
            
            $contact_form_shortcode = get_post_meta(get_the_ID(), "m2sys_landing_page_contact_form", true);                
            
            ob_start();
            do_shortcode('[m2sys_template_menu]');
            $navmenu = ob_get_contents();
            ob_end_clean();
            
            ob_start();
            echo apply_shortcodes($contact_form_shortcode);
            $contact_form = ob_get_contents();
            ob_end_clean();

            $content = htmlspecialchars_decode(str_replace("|_|", "'", get_the_content()));
            /* eval("?> $content <?php "); */

            echo str_replace(['@@pagemainmenu@@','@@contactform@@'],[$navmenu,$contact_form],$content);

            //echo   get_the_content()          ;
            ?>
        <?php endwhile; ?>


        <?php do_action('sydney_before_footer'); ?>

        <?php if (is_active_sidebar('footer-1')) : ?>
            <?php get_sidebar('footer'); ?>
        <?php endif; ?>

        <?php $container = get_theme_mod('footer_credits_container', 'container'); ?>
        <?php $credits = sydney_footer_credits(); ?>

        <footer id="colophon" class="site-footer">
            <div class="<?php echo esc_attr($container); ?>">
                <div class="site-info">
                    <div class="row">
                        <div class="col-md-6">
                            <?php echo wp_kses_post($credits); ?>
                        </div>
                        <div class="col-md-6">
                            <?php sydney_social_profile('social_profiles_footer'); ?>
                        </div>					
                    </div>
                </div>
            </div><!-- .site-info -->
        </footer><!-- #colophon -->

        <?php do_action('sydney_after_footer'); ?>

    </div><!-- #page -->

    <?php wp_footer(); ?>

</body>
</html>
