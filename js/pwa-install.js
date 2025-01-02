let deferredPrompt;

window.addEventListener("beforeinstallprompt", (event) => {
    // Prevent the default mini-infobar from appearing
    event.preventDefault();
    deferredPrompt = event;

    // Show your custom install prompt
    const installButton = document.createElement("button");
    installButton.textContent = "Install App";
    installButton.style.cssText = `
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 10px 20px;
        background-color: #0073aa;
        color: #fff;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        z-index: 1000;
    `;
    document.body.appendChild(installButton);

    installButton.addEventListener("click", () => {
        // Trigger the install prompt
        deferredPrompt.prompt();

        // Wait for the user's response
        deferredPrompt.userChoice.then((choiceResult) => {
            if (choiceResult.outcome === "accepted") {
                console.log("User accepted the install prompt");
            } else {
                console.log("User dismissed the install prompt");
            }
            deferredPrompt = null;
        });

        // Remove the button after interaction
        installButton.remove();
    });
});
