document.getElementById('button-add').addEventListener('click', function () {
    document.querySelector('.modal-add-coin').style.display = 'flex'
});

document.querySelector('.close').addEventListener('click', function () {
    document.querySelector('.modal-add-coin').style.display = 'none'
});

function hamburgerMenuOnClick() {
    document.getElementById("hamburger__menu").classList.toggle("change");
    document.getElementsByClassName("navbar__items")[0].classList.toggle("change");
    var elems = document.getElementsByClassName("navbar__item");
    for(var i = 0; i<elems.length;i++) {
        elems[i].classList.toggle("change");
    }
  } 
