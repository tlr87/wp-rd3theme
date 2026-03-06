<?php
// Only load in WordPress
if (!defined('ABSPATH')) exit;

// Include this file from your theme's functions.php
// require get_template_directory() . '/support-email-module.php';

// Add admin menu
add_action('admin_menu', function() {
    add_menu_page(
        'Support Email',
        'Support Email',
        'manage_options',
        'theme-support-email',
        'theme_support_email_page',
        'dashicons-email-alt',
        60
    );
});

// Render admin page
function theme_support_email_page() {
    if (isset($_POST['theme_support_send'])) {
        check_admin_referer('theme_support_nonce');

        $to      = sanitize_email($_POST['to_email']);
        $subject = sanitize_text_field($_POST['subject']);
        $message = wp_kses_post($_POST['message']);

        $headers = ['Content-Type: text/html; charset=UTF-8'];

        // Send email
        $sent = wp_mail($to, $subject, $message, $headers);

        echo $sent
            ? '<div class="notice notice-success"><p>Email sent successfully!</p></div>'
            : '<div class="notice notice-error"><p>Failed to send email.</p></div>';
    }

    $default_message = <<<HTML
<p>Hello,</p>
<p>Thank you so much for your help with rd3tech.com! I’m thrilled that the Email Routing → Remote fix worked — WordPress emails are now delivering perfectly to Gmail, which is fantastic.</p>
<p>I also provide technical support for other websites hosted on the same server, specifically:</p>
<ul>
<li><a href="https://lighthousechurch.nz/" target="_blank">lighthousechurch.nz</a></li>
<li><a href="https://ngunguruhall.nz/" target="_blank">ngunguruhall.nz</a></li>
</ul>
<p>I’ve noticed that both of these sites are sending WordPress emails via PHP <code>mail()</code>, and I want to ensure they deliver correctly without going to spam or being quarantined, similar to the fix for rd3tech.com.</p>
<p>Could you advise the best way to configure these sites so that:</p>
<ol>
<li>Outgoing WordPress emails are routed correctly via their MX records.</li>
<li>Reverse DNS (PTR) and SPF/DKIM/DMARC settings are properly aligned.</li>
<li>Emails do not get blocked or quarantined by Google Workspace or other providers.</li>
</ol>
<p>Any guidance or step-by-step recommendations would be greatly appreciated.</p>
<p>Kind regards,<br>Tom Revill</p>
HTML;

    ?>
    <div class="wrap">
        <h1>Send Support Email</h1>
        <form method="post">
            <?php wp_nonce_field('theme_support_nonce'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="to_email">To Email</label></th>
                    <td><input type="email" id="to_email" name="to_email" value="support@yourhost.com" class="regular-text" required></td>
                </tr>
                <tr>
                    <th><label for="subject">Subject</label></th>
                    <td><input type="text" id="subject" name="subject" value="Question: WordPress Email Delivery Issue" class="regular-text" required></td>
                </tr>
                <tr>
                    <th><label for="message">Message</label></th>
                    <td><textarea id="message" name="message" rows="15" class="large-text code"><?php echo esc_textarea($default_message); ?></textarea></td>
                </tr>
            </table>
            <p class="submit"><input type="submit" name="theme_support_send" class="button button-primary" value="Send Email"></p>
        </form>
    </div>
    <?php
}