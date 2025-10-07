<footer class="footer-container">
    <div class="container text-center py-4 flex jc-between">
        <p>Copyright © <?php echo date('Y'); ?> - All rights reserved</p>
        <div class="social-links">
            <a href="<?php echo esc_url(get_option('facebook_link', '#')); ?>" target="_blank">Facebook</a>
            <a href="<?php echo esc_url(get_option('twitter_link', '#')); ?>" target="_blank">Twitter</a>
            <a href="<?php echo esc_url(get_option('instagram_link', '#')); ?>" target="_blank">Instagram</a>
        </div>
    </div>
</footer>
<?php wp_footer() ?>
</body>

</html>