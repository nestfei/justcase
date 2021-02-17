import { toggleAuthNav } from "./toggleAuthNav";

// ログインログアウトwindow開閉
document.querySelector("#js-toggle-auth").addEventListener("click", () => {
    toggleAuthNav();
});
