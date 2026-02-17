<?php
// Get the back message from Customizer
$back_message = get_theme_mod('rd3_maintenance_back_message', 'We are back!');
?>
<script>
// Countdown timer using Customizer date
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
