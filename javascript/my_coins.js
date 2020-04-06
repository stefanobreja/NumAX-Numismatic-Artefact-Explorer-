document.getElementById('button-add').addEventListener('click', function () {
    document.querySelector('.modal-add-coin').style.display = 'flex'
});

document.querySelector('.close').addEventListener('click', function () {
    document.querySelector('.modal-add-coin').style.display = 'none'
});
