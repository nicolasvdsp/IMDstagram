let hideShow = document.querySelector(".hideShow");
let hideShowRep = document.querySelector(".hideShowRep");
let password = document.querySelector('.password');
let passwordRep = document.querySelector('.passwordRep');

hideShow.addEventListener('click', function(e){
    if (password.type === "password") {
        password.type = "text";
      } else {
        password.type = "password";
      }
});

hideShowRep.addEventListener('click', function(e){
    console.log('rep');
    if (passwordRep.type === "password") {
        passwordRep.type = "text";
      } else {
        passwordRep.type = "password";
      }
});