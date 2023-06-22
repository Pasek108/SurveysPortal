"use strict";

const mobile_menu_button = document.querySelector("#mobile-menu-button");
mobile_menu_button.addEventListener("click", () => mobile_menu.classList.toggle("hidden"));

const mobile_menu = document.querySelector("#mobile-menu");
document.addEventListener("scroll", () => mobile_menu.classList.add("hidden"));
document.addEventListener("click", (evt) => {
    if (mobile_menu.contains(evt.target) || mobile_menu_button.contains(evt.target)) return;
    mobile_menu.classList.add("hidden");
});
