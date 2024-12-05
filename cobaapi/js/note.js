const btnAddNote = document.querySelector('#btnAddNote');
const formNote = document.querySelector('#formNote');

btnAddNote.addEventListener('click', ()=> {
    event.preventDefault();

    let note = new FormData(formNote);

    let xhr = new XMLHttpRequest;
    xhr.open('POST', 'http://localhost/cobaapi/api/addnote.php');
    xhr.onreadystatechange = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            alert(JSON.parse(xhr.response).message);
        }
    }
    xhr.send(note);
})

