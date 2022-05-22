document.querySelector('#signUp-meal').addEventListener('click', function() {
    document.querySelector('.pop-up').style.display = 'block';
    document.querySelector('.pop-up-bg').style.opacity = '0.2';
});

document.querySelector('#confirm-signUp-meal').addEventListener('click', function() {
    document.querySelector('.pop-up').style.display = 'none';
    document.querySelector('.pop-up-bg').style.opacity = '1.0';
});

document.querySelector('#annulation').addEventListener('click', function() {
    document.querySelector('.pop-up').style.display = 'none';
    document.querySelector('.pop-up-bg').style.opacity = '1.0';
});