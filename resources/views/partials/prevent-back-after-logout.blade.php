<script>
(function () {
    // Keep user on login page when pressing browser Back after logout
    if (window.history && window.history.pushState) {
        window.history.pushState(null, document.title, window.location.href);
        window.addEventListener('popstate', function () {
            window.history.pushState(null, document.title, window.location.href);
        });
    }
})();
</script>
