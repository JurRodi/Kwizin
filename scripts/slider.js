let sliders = document.querySelectorAll(".slider");

let priceSlider = document.getElementById('price');
let priceOutput = document.getElementById('price-output');
if(priceSlider) {
    priceOutput.innerHTML = "€"+priceSlider.value;
}

let distanceSlider = document.getElementById('distance');
let distanceOutput = document.getElementById('distance-output');
if(distanceSlider){
    distanceOutput.innerHTML = distanceSlider.value+"km";
}

sliders.forEach(slider => {
    slider.oninput = function() {
        if (this.id == "price") {
            priceOutput.innerHTML = "€"+this.value;
        } else if (this.id == "distance") {
            distanceOutput.innerHTML = this.value+"km";
        }
    }
});