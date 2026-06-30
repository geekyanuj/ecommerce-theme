document.addEventListener("DOMContentLoaded", () => {

    const userBtn = document.getElementById("userMenuBtn");
    const dropdown = document.getElementById("userDropdown");

    if (userBtn && dropdown) {

        userBtn.addEventListener("click", function (e) {
            e.stopPropagation();
            dropdown.classList.toggle("show");
        });

        document.addEventListener("click", function () {
            dropdown.classList.remove("show");
        });

        dropdown.addEventListener("click", function (e) {
            e.stopPropagation();
        });

    }

});