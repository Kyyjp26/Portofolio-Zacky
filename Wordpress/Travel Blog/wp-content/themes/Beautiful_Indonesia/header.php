<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="<?php bloginfo('charset') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head() ?>
</head>

<body <?php body_class() ?>>
    <?php wp_body_open() ?>

    <header class="navbar-container">
        <nav class="container flex jc-between ai-center">
            <a href="<?php echo esc_url(home_url()) ?>">
                <h2>Beautiful Indonesia</h2>
            </a>
            <div class="flex gap-3 ai-center">
                <?php
                wp_nav_menu();
                ?>
            </div>
            <div>
                <?php
                if (is_user_logged_in()) { ?>
                    <a href="<?php echo esc_url(wp_logout_url(home_url())) ?>" class="btn btn-danger">Logout</a>
                <?php
                } else { ?>
                    <a href="<?php echo esc_url(home_url('/4dm1n')) ?>" class="btn btn-outline">Login</a>
                    <button class="btn">Register</button>
                <?php }
                ?>
            </div>
        </nav>
    </header>