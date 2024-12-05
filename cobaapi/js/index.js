const main = document.querySelector('#main-index');
const formUpdateNote = document.querySelector('#form-update-note');
const btnUpdateNote = document.querySelector('#btn-update-note');
const btnCancelUdate = document.querySelector('#btn-cancel-update');

let idNote;
if(window.location.href == 'http://localhost/cobaapi/' || window.location.href == 'http://localhost/cobaapi/index.php') {
    let xhr = new XMLHttpRequest;
    xhr.open('GET', 'api/getnotes.php');
    xhr.onreadystatechange = () => {
        if(xhr.status == 200 && xhr.readyState == 4) {
            let notes = JSON.parse(xhr.response).notes;
            console.log(notes);

            notes.forEach(note => {
                main.innerHTML += `
                    <div class="note-container h-fit shadow-2xl p-3 grid gap-3 relative">
                        <button data-idnote="${note.id_note}" class="btn-delete-note w-20 h-fit bg-red-500 text-white rounded-full text-lg absolute -right-3">Delete</button>
                        <button data-idnote="${note.id_note}" class="btn-edit-note w-20 h-fit bg-blue-500 text-white rounded-full text-lg absolute -right-3 top-10">Update</button>
                        <p class="text-gray-500">${note.date}</p>
                        <p>${note.note}</p>
                    </div>
                `;
            })

            const btnDelNote = document.querySelectorAll('.btn-delete-note');
            const btnEditNote = document.querySelectorAll('.btn-edit-note');
            
            // Delete Notes
            btnDelNote.forEach(btn => {
                btn.addEventListener('click', () => {
                    let dxhr = new XMLHttpRequest;
                    dxhr.open('DELETE', `api/deletenote.php?id=${btn.dataset.idnote}`);
                    dxhr.onreadystatechange = () => {
                    if(dxhr.readyState == 4 && dxhr.status == 200) {
                        alert(JSON.parse(dxhr.response).message);
                        btn.parentElement.remove();
                    }
                    }
                    dxhr.send();
                })
            }) 

            // Update Notes
            btnEditNote.forEach(btn => {
                btn.addEventListener('click', () => {
                    formUpdateNote.parentElement.classList.toggle('hidden');
                    idNote = btn.dataset.idnote;
                })
            })
        }
    }
    xhr.send();
}

formUpdateNote.addEventListener('submit', ()=> {
    event.preventDefault();

    let formDataUpdateNote = new FormData(formUpdateNote);
    formDataUpdateNote.append('id', idNote);

    let uxhr = new XMLHttpRequest;
    uxhr.open('POST', `api/updatenote.php?id=${idNote}`);
    uxhr.onreadystatechange = () => {
        if(uxhr.readyState == 4 && uxhr.status == 200) {
            alert(JSON.parse(uxhr.response).message);

            let noteContainer = document.querySelectorAll('.note-container');
            let noteDate = new Date().toLocaleDateString('sv-SE');
            let formatted = noteDate.replace(/\//gi, '-')

            noteContainer.forEach(noteCont => {
                if(noteCont.children[0].dataset.idnote == idNote) {
                    noteCont.children[2].innerHTML = formatted;
                    noteCont.children[3].innerHTML = document.querySelector('#note').value;
                }
            })
        }
    }
    uxhr.send(formDataUpdateNote);
})

btnCancelUdate.addEventListener('click', ()=> {
    formUpdateNote.parentElement.classList.toggle('hidden');
    formUpdateNote.reset();
})