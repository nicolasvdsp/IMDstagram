let fileSelect = document.querySelector('#postPicture');

fileSelect.addEventListener("change", function(e){
    let preview = document.querySelector(".prev");
    preview.classList.add('post__prevImage');
    preview.src = URL.createObjectURL(e.target.files[0]);
});