const iconMenu = document.getElementById("icon-Menu");
const dropDownMenu = document.getElementById("dropdown-Menu");
const kategoriDropdown = document.querySelector('.nav-link.dropdown-toggle');
const dropdownList = document.querySelector('.dropdown-fullscreen');
const dropdownArrow = document.querySelector('.dropdown-Arrow');
const kategoriDropdownResponsive = document.querySelector('.dropdown-toggle-responsive');
const dropdownArrowResponsive = kategoriDropdownResponsive.querySelector('.ph-caret-down');
const dropdownListResponsive = document.querySelector('.dropdown-responsive');
const Arrow = document.getElementById('dropdown-Arrow');

const dropdownLinks = document.querySelectorAll('a[data-href]');

window.onload = function () {
    dropDownMenu.classList.remove("open");
    dropdownList.classList.remove("open");
    dropdownListResponsive.classList.remove("open");
};

iconMenu.onclick = function(){
    dropDownMenu.classList.toggle("open");
    const isOpen = dropDownMenu.classList.contains("open");

    iconMenu.innerHTML = isOpen
    ? '<i class="ph ph-x"></i>'
    : '<i class="ph ph-list"></i>';
};

kategoriDropdown.onclick = function(e) {
    e.preventDefault();
    dropdownList.classList.toggle("open");
    kategoriDropdown.classList.toggle("open");
    isAtas = dropdownList.classList.contains("open");

    if (isAtas) {
        Arrow.classList.remove("ph-caret-down");
        Arrow.classList.add("ph-caret-up");
    } else {
        Arrow.classList.remove("ph-caret-up");
        Arrow.classList.add("ph-caret-down");
    }
};


kategoriDropdownResponsive.onclick = function(e){
    e.preventDefault();
    const screenWidth = window.innerWidth;

    if (screenWidth <= 768) {
        dropdownListResponsive.classList.toggle("open");

        const isDropdownOpenResponsive = dropdownListResponsive.classList.contains("open");
        dropdownArrowResponsive.style.transform = isDropdownOpenResponsive ? 'rotate(-90deg)' : 'rotate(0deg)';
        dropDownMenu.style.width = isDropdownOpenResponsive ? '240px' : '125px';
    }
};

dropdownLinks.forEach(link => {
    link.addEventListener('click', function (e) {
        e.preventDefault(); // Hindari reload halaman
        const targetUrl = link.getAttribute('data-href'); // Ambil URL dari atribut data-href
        window.location.href = targetUrl; // Navigasi ke URL
    });
});


document.addEventListener("click", function (e) {
    if (!kategoriDropdown.contains(e.target) && !dropdownList.contains(e.target)) {
        dropdownList.classList.remove("open");
        kategoriDropdown.classList.remove("open");
        dropdownArrow.style.transform = 'rotate(0deg)';
    }

    if (!kategoriDropdownResponsive.contains(e.target) && !dropdownListResponsive.contains(e.target)) {
        dropdownListResponsive.classList.remove("open");
    }
});