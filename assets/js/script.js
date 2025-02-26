// SaaSPress JavaScript File

document.addEventListener("DOMContentLoaded", function () {
    console.log("SaaSPress script loaded successfully!");

    // Example: Add a click event to a button with class "button-primary"
    const primaryButton = document.querySelector(".button-primary");
    if (primaryButton) {
        primaryButton.addEventListener("click", function () {
            alert("Button clicked!");
        });
    }

    // Example: Toggle visibility of elements with class "saaspress-card"
    const cards = document.querySelectorAll(".saaspress-card");
    cards.forEach(card => {
        card.addEventListener("click", function () {
            this.classList.toggle("active");
        });
    });
});