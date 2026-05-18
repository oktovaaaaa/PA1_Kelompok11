document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.querySelector("#sidebar");
    const desktopToggle = document.querySelector(".toggle-btn");
    const mobileToggle = document.querySelector(".mobile-toggle-btn");
    const backdrop = document.querySelector(".sidebar-backdrop");

    function toggleDesktopSidebar() {
        // Desktop ONLY toggles expand class on sidebar, no backdrop, no blur
        sidebar.classList.toggle("expand");
    }

    function toggleMobileSidebar() {
        // Mobile toggles both sidebar expand and body sidebar-open overlay
        sidebar.classList.toggle("expand");
        document.body.classList.toggle("sidebar-open");
    }

    if (desktopToggle) {
        desktopToggle.addEventListener("click", toggleDesktopSidebar);
    }

    if (mobileToggle) {
        mobileToggle.addEventListener("click", toggleMobileSidebar);
    }

    if (backdrop) {
        backdrop.addEventListener("click", function () {
            sidebar.classList.remove("expand");
            document.body.classList.remove("sidebar-open");
        });
    }
});
