document.addEventListener("DOMContentLoaded", function () {
    const popup = document.getElementById("install-pwa-popup");
    const dismissButton = document.getElementById("dismiss-pwa-popup");
    const installButton = document.getElementById("install-pwa-button");

    const DISMISS_COUNT_KEY = "pwaPopupDismissCount";
    const MAX_DISMISS_COUNT = 2;

    // Get the current dismissal count
    let dismissCount = parseInt(localStorage.getItem(DISMISS_COUNT_KEY)) || 0;

    // Show the popup only if the dismiss count is below the max limit
    if (dismissCount < MAX_DISMISS_COUNT) {
        popup.style.display = "block";
    }

    // Handle dismiss button click
    dismissButton.addEventListener("click", function () {
        dismissCount += 1;
        localStorage.setItem(DISMISS_COUNT_KEY, dismissCount);

        // Hide the popup
        popup.style.display = "none";
    });

    // Handle install button click (example logic)
    installButton.addEventListener("click", function () {
        // Add your installation logic here
        alert("Installation process started.");
        popup.style.display = "none";
    });
});
