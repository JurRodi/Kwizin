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
    viewIngredient(str); 
    ingredients.push(str);
    console.log(ingredients);
}

function viewIngredient(str){
    // let html = '<div class="ingredient">'+result.body.name+'</div>';
    let html = '<div class="ingredient">'+str+'</div>';
    document.getElementById("ingredient-list").innerHTML += html;
}

document.querySelector('#mealUpload').addEventListener('click', function(e){ 
    e.preventDefault();
    console.log(ingredients);
    let formData = new FormData();
    formData.append('culture', document.querySelector('#culture').value);
    formData.append('name', document.querySelector('#name').value);
    formData.append('description', document.querySelector('#description').value);
    formData.append('price', document.querySelector('#price').value);
    formData.append('location', document.querySelector('#location').value);
    formData.append('meetingTime', document.querySelector('#meetingTime').value);
    formData.append('ingredients', ingredients);

    fetch('ajax/addIngredients.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            console.log('Success:', result);
        })
        .catch(error => {
            console.error('Error:', error);
        });
});