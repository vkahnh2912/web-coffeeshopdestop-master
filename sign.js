const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container");

sign_up_btn.addEventListener("click", () => {
    container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
    container.classList.remove("sign-up-mode");
});
document.addEventListener("DOMContentLoaded", function() {
    const userMenu = document.querySelector(".user-menu");
    const dropdown = document.querySelector(".dropdown-menu");

    if (userMenu) {
        userMenu.addEventListener("click", function(e) {
            e.stopPropagation();
            userMenu.classList.toggle("show");
        });

        document.addEventListener("click", function() {
            userMenu.classList.remove("show");
        });
    }
});
