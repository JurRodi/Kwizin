document.querySelector('#messageInput').addEventListener('keypress', function(e){ 
    if(e.keyCode === 13){
        e.preventDefault();
        let message = document.querySelector('#messageInput').value;
        add(message, e);
        
    }
});

function add(str, e){
    if (str.length==0) {
        return;
    }

    let sender = e.target.dataset.sender;
    let reciever = e.target.dataset.reciever;

    let formData = new FormData();
    formData.append('message', str);
    formData.append('sender_id', sender);
    formData.append('reciever_id', reciever);

    fetch('ajax/chatHandler.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            // console.log('Success:', result);
            document.querySelector('#messageInput').value = '';
            addMessage(result);
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

function addMessage(result){
    let html = '<div class="chat-message-right-text"><p>'+result.body.message+'</p></div>';
    let chat = document.querySelector(".chat-messages");
    let div = document.createElement("div");
    div.classList.add("chat-message-right");
    chat.prepend(div);
    div.innerHTML = html;
}