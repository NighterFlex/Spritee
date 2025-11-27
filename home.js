const menuicon = document.getElementById("menubar");
const cross = document.getElementById("crossicon");
const navbk = document.querySelector(".navback");
const nav = document.querySelector(".nav1");
const navli = document.querySelector("nav li");

// In case some pages don't have these elements
if (menuicon && cross && navbk && nav) {
    menuicon.addEventListener("click", function () {
        // alert("Hello"); // optional test
        navbk.style.right = "-1px";
    });
    
    cross.addEventListener("click", function () {
        navbk.style.right = "-200px";
    });

    navbk.addEventListener("click", function () {
        // alert("Hello"); // optional test
        navbk.style.right = "-200px";
    });
    navli.addEventListener("click", function () {
        // alert("Hello"); // optional test
        navbk.style.right = "-200px";
    });
}
