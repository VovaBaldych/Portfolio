<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset=»<?php bloginfo( ‘charset’ ); ?>»>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/fontawesome.css">
    <link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/style.css">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="mobile-menu">
        <div class="close"><i class="fas fa-times"></i></div>

        <?php wp_nav_menu( [
                    'theme_location'  => 'my-custom-menu-mobile',
                    'menu'            => '', 
                    'container'       => false, 
                    'container_class' => '', 
                    'container_id'    => '',
                    'menu_class'      => 'mobile-menu', 
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
                ] );?>

            <div class="mobile-eng"><a href="/blog-1">BLOG</a></div>
            
    </div>

    <header>

        <div class="empty-space"><a class="eng" href="/blog-1">BLOG</a></div>


                <?php wp_nav_menu( [
                    'theme_location'  => 'my-custom-menu-left',
                    'menu'            => '', 
                    'container'       => false, 
                    'container_class' => '', 
                    'container_id'    => '',
                    'menu_class'      => 'menu-block', 
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
                ] );?>

                    <a href="#" class="logo">KøL</a>
            
                    <?php wp_nav_menu( [
                    'theme_location'  => 'my-custom-menu-right',
                    'menu'            => '', 
                    'container'       => false, 
                    'container_class' => '', 
                    'container_id'    => '',
                    'menu_class'      => 'menu-block', 
                    'menu_id'         => '',
                    'echo'            => true,
                    'fallback_cb'     => 'wp_page_menu',
                    'before'          => '',
                    'after'           => '',
                    'link_before'     => '',
                    'link_after'      => '',
                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'           => 0,
                    'walker'          => '',
                ] );?>



            <div class="empty-space">
            <div class="burger-menu"><i class="fas fa-bars"></i></div>
            </div>
            
    </header>

    