<?php
/**
 * Maintenance Page Template
 */

// Get Customizer settings
$bg_color        = get_theme_mod('rd3_maintenance_bg', '#f7f7f7');
$text_color      = get_theme_mod('rd3_maintenance_text', '#333');
$logo            = get_theme_mod('rd3_maintenance_logo', '');
$title           = get_theme_mod('rd3_maintenance_title', 'Site Under Maintenance');
$message         = get_theme_mod('rd3_maintenance_message', 'We’re making improvements. Please check back soon.');
$countdown_date  = get_theme_mod('rd3_maintenance_countdown', date('Y-m-d H:i:s', strtotime('+3 days')));
$back_message    = get_theme_mod('rd3_maintenance_back_message', 'We are back!');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo esc_html($title); ?></title>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/maintenance.css">
    <style>
        body {
            background-color: <?php echo $bg_color; ?>;
            color: <?php echo $text_color; ?>;
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <?php if ($logo): ?>
            <img src="<?php echo esc_url($logo); ?>" alt="Logo" class="maintenance-logo">
        <?php endif; ?>

        <h1><?php echo esc_html($title); ?></h1>
        <p><?php echo esc_html($message); ?></p>

        <div id="countdown"></div>
    </div>

    <script>
        // Countdown timer
        const countdownDate = new Date("<?php echo esc_js($countdown_date); ?>").getTime();
        const countdownEl = document.getElementById('countdown');

        function updateCountdown() {
            const now = new Date().getTime();
            const distance = countdownDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000*60*60));
            const minutes = Math.floor((distance % (1000*60*60)) / (1000*60));
            const seconds = Math.floor((distance % (1000*60)) / 1000);

            if (distance > 0) {
                countdownEl.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
            } else {
                countdownEl.innerHTML = "<?php echo esc_js($back_message); ?>";
            }
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>
</body>
</html>
