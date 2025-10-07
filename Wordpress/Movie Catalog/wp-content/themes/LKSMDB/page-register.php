<?php
/* Template Name: Custom Register */

if (is_user_logged_in()) {
    wp_redirect(home_url());
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username   = sanitize_user($_POST['username'] ?? '');
    $email      = sanitize_email($_POST['email'] ?? '');
    $password   = $_POST['password'] ?? '';
    $password2  = $_POST['password2'] ?? '';

    // Validasi sederhana
    if (empty($username) || empty($email) || empty($password) || empty($password2)) {
        $error = 'Semua field wajib diisi.';
    } elseif (!is_email($email)) {
        $error = 'Email tidak valid.';
    } elseif (username_exists($username)) {
        $error = 'Username sudah digunakan.';
    } elseif (email_exists($email)) {
        $error = 'Email sudah digunakan.';
    } elseif ($password !== $password2) {
        $error = 'Password dan konfirmasi password tidak cocok.';
    } else {
        // Buat user baru
        $user_id = wp_create_user($username, $password, $email);
        if (is_wp_error($user_id)) {
            $error = $user_id->get_error_message();
        } else {
            // Otomatis login user setelah registrasi
            wp_set_current_user($user_id);
            wp_set_auth_cookie($user_id);
            wp_redirect(home_url());
            exit;
        }
    }
}

get_header();
?>

<div class="container flex py-4 jc-center" id="auth-fullscreen">
    <div class="auth-container">
        <h2 class="mb-2">Register</h2>
        <div class="card">
            <form method="post" id="loginform">
                <?php if ($error): ?>
                    <div style="color:red;"><?php echo esc_html($error); ?></div>
                <?php endif; ?>
                <div class="register-username">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required value="<?php echo isset($_POST['username']) ? esc_attr($_POST['username']) : ''; ?>">
                </div>
                <div class="register-email">
                    <label for="email">Email</label> <input type="email" name="email" id="email" required value="<?php echo isset($_POST['email']) ? esc_attr($_POST['email']) : ''; ?>">
                </div>
                <div class="register-password">
                    <label for="password">Password</label> <input type="password" name="password" id="password" required>
                </div>
                <div class="register-password">
                    <label for="password2">Konfirmasi Password</label> <input type="password" name="password2" id="password2" required>
                </div>
                <div style="margin-top: 5px;">
                    <button type="submit" class="btn btn-primary">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>