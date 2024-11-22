const container = document.getElementById("container");
const registerBtn = document.getElementById("register");
const loginBtn = document.getElementById("login");
const imageSide = document.querySelector(".image-side");

registerBtn.addEventListener("click", () => {
    container.classList.add("active");
    registerBtn.classList.add("hide");
    loginBtn.classList.remove("hide");
});

loginBtn.addEventListener("click", () => {
    container.classList.remove("active");
    loginBtn.classList.add("hide");
    registerBtn.classList.remove("hide");
});
