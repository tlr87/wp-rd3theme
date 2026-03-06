<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?> 

    <!-- Toggle Sidebar Button -->
    <button id="toggle-sidebar" class="sidebar-toggle-button">
        <span class="arrow right"></span>
        Toggle Sidebar
    </button>

    <div class="main-sidebar-wrapper" style="display: block;">
        <?php dynamic_sidebar( 'main-sidebar' ); ?>
    </div>

    <script>
        (function() {
            const toggleButton = document.getElementById('toggle-sidebar');
            const sidebar = document.querySelector('.main-sidebar-wrapper');
            const arrow = toggleButton.querySelector('.arrow');

            // Function to update arrow based on sidebar visibility
            function updateArrow() {
                if (sidebar.style.display === 'none' || getComputedStyle(sidebar).display === 'none') {
                    arrow.classList.remove('down');
                    arrow.classList.add('right');
                } else {
                    arrow.classList.remove('right');
                    arrow.classList.add('down');
                }
            }

            // Initial arrow state
            updateArrow();

            // Toggle sidebar on click
            toggleButton.addEventListener('click', () => {
                if (sidebar.style.display === 'none' || getComputedStyle(sidebar).display === 'none') {
                    sidebar.style.display = 'block';
                } else {
                    sidebar.style.display = 'none';
                }
                updateArrow();
            });
        })();
    </script>

<?php endif; ?>