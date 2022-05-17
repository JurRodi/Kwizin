document.querySelector('#signUp-meal').addEventListener('click', function() {
    document.querySelector('.pop-up').style.display = 'block';
});

document.querySelector('#confirm-signUp-meal').addEventListener('click', function() {
    document.querySelector('.pop-up').style.display = 'none';
});

document.querySelector('#annulation').addEventListener('click', function() {
    document.querySelector('.pop-up').style.display = 'none';
});