"use strict";

window.addEventListener("DOMContentLoaded", () => {
    const latest_button = document.querySelector("#latest-button");
    const popular_button = document.querySelector("#popular-button");
    const indicator = document.querySelector("#indicator");

    const latest_container = document.querySelector("#latest");
    const popular_container = document.querySelector("#popular");

    latest_button.addEventListener("click", () => {
        popular_button.classList.remove("text-white");
        latest_button.classList.add("text-white");

        indicator.style.transform = "translateX(100%)";

        popular_container.style.display = "none";
        latest_container.style.display = null;

    });

    popular_button.addEventListener("click", () => {
        popular_button.classList.add("text-white");
        latest_button.classList.remove("text-white");

        indicator.style.transform = null;

        popular_container.style.display = null;
        latest_container.style.display = "none";
    });
});
