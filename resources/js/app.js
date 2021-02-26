import { toggleAuthNav } from "./toggleAuthNav";

// ログインログアウトwindow開閉
document.querySelector("#js-toggle-auth").addEventListener("click", () => {
    toggleAuthNav();
});

document
    .querySelector("#search_products_open")
    .addEventListener("click", () => {
        document.querySelector(".Search-products").style.display = "block";
    });

document
    .querySelector("#search_products_close")
    .addEventListener("click", () => {
        document.querySelector(".Search-products").style.display = "none";
    });
