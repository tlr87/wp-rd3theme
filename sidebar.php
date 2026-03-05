<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?> 

    <!-- Toggle Sidebar Button -->
    <button id="toggle-sidebar" class="sidebar-toggle-button">Toggle Sidebar</button>

    <div class="main-sidebar-wrapper">
        <?php dynamic_sidebar( 'main-sidebar' ); ?>
    </div>

    <script>
        (function() {
            const toggleButton = document.getElementById('toggle-sidebar');
            const sidebar = document.querySelector('.main-sidebar-wrapper');

            // Function to check screen width
            function updateToggleButton() {
                const width = window.innerWidth;
                if (width <= 1024) { 
                    toggleButton.style.display = 'block';
                } else {
                    toggleButton.style.display = 'none';
                    sidebar.style.display = 'block'; // ensure sidebar visible on desktop
                }
            }

            // Initial check
            updateToggleButton();

            // Update on resize
            window.addEventListener('resize', updateToggleButton);

            // Toggle sidebar on click
            toggleButton.addEventListener('click', () => {
                if (sidebar.style.display === 'none' || getComputedStyle(sidebar).display === 'none') {
                    sidebar.style.display = 'block';
                } else {
                    sidebar.style.display = 'none';
                }
            });
        })();
    </script>

<?php endif; ?>