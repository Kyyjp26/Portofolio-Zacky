<?php
if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

get_header();

?>
<div class="container flex py-4 jc-center" id="auth-fullscreen">
    <div class="auth-container">
        <h2 class="mb-2">Login</h2>

        <div class="card">
            <?php
            $args = array(
                'redirect'       => home_url(),
                'label_username' => __('Username or Email'),
                'label_password' => __('Password'),
                'label_remember' => __('Remember Me'),
                'label_log_in'   => __('Log In'),
                'remember'       => true,
            );

            wp_login_form($args);
            ?>
        </div>
    </div>
</div>
<?php
get_footer()
?>