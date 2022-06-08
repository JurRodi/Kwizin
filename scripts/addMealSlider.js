let slider = document.getElementById('price');
let output = document.getElementById('price-output');
output.innerHTML = slider.value;

slider.oninput = function() {
    output.innerHTML = "€"+this.value;
}

slider.oninput();