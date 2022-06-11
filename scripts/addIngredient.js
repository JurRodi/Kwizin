document.querySelector('.add-ingredient').addEventListener('click', function(e){ 
    e.preventDefault();
    let ingredient = document.querySelector('#ingredient').value;
    add(ingredient);
});
let ingredients = [];

function add(str){
    if (str.length==0) {
        alert("Please enter an ingredient");
        return;
    }
    ingredients.push(str);
    viewIngredient(str); 
}

function viewIngredient(str){
    let html = '<div class="ingredient">'+str+'</div>';
    document.getElementById("ingredient-list").innerHTML += html;
}

document.querySelector('#mealUpload').addEventListener('click', function(){
    let array = document.querySelector('#ingredient');
    array.value = JSON.stringify(ingredients);
});