// SaaSPress JavaScript File

document.addEventListener("DOMContentLoaded", function () {
    console.log("SaaSPress script loaded successfully!");

    // Add click event to all primary buttons
    const primaryButtons = document.querySelectorAll(".button-primary");
    primaryButtons.forEach(button => {
        button.addEventListener("click", function () {
            alert("Button clicked!");
        });
    });

    // Toggle visibility of cards
    const cards = document.querySelectorAll(".saaspress-card");
    cards.forEach(card => {
        card.addEventListener("click", function () {
            this.classList.toggle("active");
            console.log("Card toggled:", this.querySelector("h2").textContent);
        });
    });

    // Add click event to secondary buttons in Help section
    const secondaryButtons = document.querySelectorAll(".saaspress-button-secondary");
    secondaryButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            alert("Reconnect functionality to be implemented!");
        });
    });

    // Add click event to info buttons in Help section
    const infoButtons = document.querySelectorAll(".saaspress-button-info");
    infoButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            alert("Redirect to documentation or support to be implemented!");
        });
    });
});