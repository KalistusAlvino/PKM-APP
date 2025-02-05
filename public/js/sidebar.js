const toggler = document.querySelector(".toggler-btn");
toggler.addEventListener("click", function () {
    document.querySelector("#sidebar").classList.toggle("collapsed");


    const icon = toggler.querySelector("i");

    icon.classList.toggle("fa-outdent"); // Hapus class ini
    icon.classList.toggle("fa-indent");  // Tambahkan class ini
});
