
<?php

function m2sys_logo() {

    if (get_theme_mod('site_logo')) :
        ?>
        <?php
        $logo_id = attachment_url_to_postid(get_theme_mod('site_logo'));
        $logo_attrs = wp_get_attachment_image_src($logo_id, 'large');
        ?>                      
        <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>"><img width="<?php echo esc_attr($logo_attrs[1]); ?>" height="<?php echo esc_attr($logo_attrs[2]); ?>" class="site-logo" src="<?php echo esc_url(get_theme_mod('site_logo')); ?>" alt="<?php bloginfo('name'); ?>" <?php sydney_do_schema('logo'); ?> /></a>
    <?php else : ?>
        <?php if (is_front_page() && is_home()) :
            ?>
            <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php
        else :
            ?>
            <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
        <?php
        endif;
        $sydney_description = get_bloginfo('description', 'display');
        if ($sydney_description || is_customize_preview()) :
            ?>
            <p class="site-description"><?php echo $sydney_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped            ?></p>
        <?php endif; ?>
    <?php
    endif;
}
?>


<header id="masthead" class="main-header header_layout_2 sticky-header sticky-always">
    <div class="container">
        <div class="site-header-inner">
            <div class="row valign">
                <div class="header-col">
                    <div class="site-branding">
                        <?php m2sys_logo(); ?>
                    </div>
                </div>
                <div class="header-col menu-col menu-right">

                    <nav id="mainnav-mobi" class="mainnav syd-hidden">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'primary',
                            'menu_id' => 'primary-menu',
                        ));
                        ?>      
                    </nav>
                </div>

            </div>
        </div>
    </div>

</header>

<div class="sydney-offcanvas-menu">
    <div class="mobile-header-item">
        <div class="row valign">
            <div class="col-xs-8">
                <div class="site-branding">
                    <?php m2sys_logo(); ?>
                </div>
            </div>
            <div class="col-xs-4 align-right">
                <a class="mobile-menu-close" href="#">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="mobile-header-item">

        <nav id="mainnav" class="mainnav">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id' => 'primary-menu',
            ));
            ?>      
        </nav>
    </div>
    <div class="mobile-header-item">
    </div>              
</div>

<header id="masthead-mobile" class="main-header mobile-header">
    <div class="container-fluid">
        <div class="row valign">
            <div class="col-sm-4 col-grow-mobile">
                <div class="site-branding">
                    <?php m2sys_logo(); ?>
                </div>
            </div>
            <div class="col-sm-8 col-grow-mobile header-elements valign align-right">
                <a href="#" class="menu-toggle">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </a>
            </div>                      
        </div>
    </div>
</header>
