//preview your chosen image
let fileSelect = document.querySelector('#postPicture');

fileSelect.addEventListener("change", function(e){
    let preview = document.querySelector(".prev");
    preview.classList.add('post__prevImage');
    preview.src = URL.createObjectURL(e.target.files[0]);
});


//preview the chosen filter on your image
let filterSelect = document.querySelector('#filter');

filterSelect.addEventListener("change", function(e){
    let filter = e.target.value;
    let figure = document.querySelector('figure');
    figure.className = filter;
});