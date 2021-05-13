let btnAddComment = document.querySelector("#btnAddComment");
let commentText = document.querySelector("#commentText");

btnAddComment.addEventListener('click', addComment);
commentText.addEventListener("keyup", function(e){
  if(e.keyCode === 13) {
      e.preventDefault();
      document.querySelector("#btnAddComment").click();
  }
});

function addComment() {
    let postId = this.dataset.postid;
    let text = document.querySelector("#commentText").value;

    console.log(postId);
    console.log(text);

    // post naar database (AJAX)
    let formData = new FormData();
    formData.append("text", text);
    formData.append("postId", postId);

    fetch("ajax/savecomment.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(result => {
            let newComment = document.createElement("li");
            newComment.innerHTML = result.body;
            document.querySelector(".post__comments__list").appendChild(newComment);
            document.querySelector("#commentText").value = "";
        })
        .catch(error => {
            console.error("Error:", error);
        });
};