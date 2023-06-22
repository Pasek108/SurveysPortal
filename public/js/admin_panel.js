"use strict";

const admin_nav = document.querySelector("#admin-nav");
const open_admin_nav = document.querySelector("#open-admin-nav");
const close_admin_nav = document.querySelector("#close-admin-nav");

const showAdminNav = () => admin_nav.classList.remove("hidden");
const hideAdminNav = () => admin_nav.classList.add("hidden");

open_admin_nav.addEventListener("click", showAdminNav);
close_admin_nav.addEventListener("click", hideAdminNav);

document.addEventListener("click", (evt) => {
    if (admin_nav.contains(evt.target) || open_admin_nav.contains(evt.target)) return;
    hideAdminNav();
});
