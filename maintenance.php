<?php
// Maintenance page template
$bg_color = get_theme_mod('rd3_maintenance_bg', '#f7f7f7');
$text_color = get_theme_mod('rd3_maintenance_text', '#333');
$logo = get_theme_mod('rd3_maintenance_logo', '');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>We'll be back soon!</title>
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
        <h1>Site Under Maintenance</h1>
        <p>We’re making improvements. Please check back soon.</p>
        <div id="countdown"></div>
    </div>

    <script>
    // Countdown timer (example: 3 days from now)
    const countdownDate = new Date();
    countdownDate.setDate(countdownDate.getDate() + 3);

    const countdownEl = document.getElementById('countdown');

    function updateCountdown() {
        const now = new Date().getTime();
        const distance = countdownDate - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000*60*60));
        const minutes = Math.floor((distance % (1000*60*60)) / (1000*60));
        const seconds = Math.floor((distance % (1000*60)) / 1000);

        countdownEl.innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

        if (distance < 0) {
            countdownEl.innerHTML = "We are back!";
        }
    }

    setInterval(updateCountdown, 1000);
    updateCountdown();
    </script>
</body>
</html>
