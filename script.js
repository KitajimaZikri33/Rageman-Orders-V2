const hamBurger = document.querySelector(".toggle-btn");
const sidebar = document.querySelector("#sidebar");

// Atur sidebar sebagai terbuka secara default
sidebar.classList.add("expand");

hamBurger.addEventListener("click", function () {
    sidebar.classList.toggle("expand");
});
