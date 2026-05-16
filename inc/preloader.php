<div id="preloader">
    <div id="spinner">
        <div class="preloader-dot-loading">
            <div class="cssload-loading"><i></i><i></i><i></i><i></i></div>
        </div>
    </div>
    <div id="disable-preloader" class="btn btn-default btn-sm">Disable Preloader</div>
</div>

<script>
    // Robust fallback to hide preloader
    (function() {
        function hidePreloader() {
            var preloader = document.getElementById('preloader');
            if (preloader && preloader.style.display !== 'none') {
                preloader.style.transition = 'opacity 0.5s ease';
                preloader.style.opacity = '0';
                setTimeout(function() {
                    preloader.style.display = 'none';
                }, 500);
            }
        }

        // Hide after 3 seconds anyway
        setTimeout(hidePreloader, 3000);

        // Hide when DOM is ready (earlier than window.load)
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(hidePreloader, 1000);
        });
    })();
</script>