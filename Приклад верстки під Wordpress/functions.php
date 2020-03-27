<?php
    function wptuts_setup()
    {
        load_theme_textdomain('wptuts');
        add_theme_support('title-tag');
    }
    add_action('after_setup_theme', 'wptuts_setup');


    function kol_theme_new_menu() {
        register_nav_menu('my-custom-menu-left',__('Ліве Меню'));
        register_nav_menu('my-custom-menu-right',__('Праве Меню'));
        register_nav_menu('my-custom-menu-mobile',__('Мобільне Меню'));
      }
      add_action('init', 'kol_theme_new_menu');
?>