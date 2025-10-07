<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open() ?>

    <header class="navbar-container" id="navbar-container">
        <nav class="container flex jc-between ai-center">
            <a href="<?php echo esc_url(home_url()) ?>">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/logo.png') ?>" alt="logo" class="navbar-logo">
            </a>

            <div class="flex ai-center gap-3 navbar-list" id="navbar-list">
                <?php
                wp_nav_menu();
                ?>

                <div>
                    <?php
                    if (!is_user_logged_in()) { ?>
                        <a href="<?php echo esc_url(home_url('/login/')) ?>" class="btn btn-primary">Login</a>
                        <a href="<?php echo esc_url(home_url('/register/')) ?>" class="btn btn-success">Register</a>
                    <?php } else { ?>
                        <a href="<?php echo esc_url(wp_logout_url(home_url())) ?>" class="btn btn-danger">Logout</a>
                    <?php } ?>
                </div>
            </div>

            <div id="hamburger-icon">&#9776;</div>
        </nav>
    </header>