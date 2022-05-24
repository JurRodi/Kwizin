let slider = document.getElementById('price');
let output = document.getElementById('price-output');
output.innerHTML = slider.value;

slider.oninput = function() {
    output.innerHTML = this.value;
    var sliderWidth = this.getBoundingClientRect().width;
    var outputWidth = output.getBoundingClientRect().width;
    var offset = this.value / (this.max - this.min) * sliderWidth - outputWidth / 2;
    output.setAttribute('style', 'left: ' + (offset+100) + 'px');
}

slider.oninput();