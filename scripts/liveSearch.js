document.querySelector('#search-meal').addEventListener('keyup', function(e){ 
    let search = document.querySelector('#search-meal').value;
    suggestions(search, e);
});

function suggestions(str, e){
    if (str.length==0) {
        let suggestions = document.getElementById("search-meal-suggestions");
        suggestions.innerHTML="";
        suggestions.style.border="0px";
        return;
    }
    let user_id = e.target.dataset.user_id;

    let formData = new FormData();
    formData.append('name', str);
    formData.append('user_id', user_id);

    fetch('ajax/liveSearch.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            // console.log('Success:', result);
            viewSuggestions(result);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function viewSuggestions(result){
    let html = '';
    for(let i=0; i<result.body.length; i++){
        html += '<a href="?s='+result.body[i].name+'" class="search-meal-suggestion">'+result.body[i].name+'</a>';
    }
    document.getElementById("search-meal-suggestions").innerHTML = html;
    document.getElementById("search-meal").style.borderRadius = "10px 10px 0 0";
}