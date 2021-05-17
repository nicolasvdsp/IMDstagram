let posts = document.querySelectorAll('.post');
console.log(posts);

let btnAddComment = document.querySelectorAll("#btnAddComment");
let commentText = document.querySelectorAll("#commentText");

posts.forEach((e) => {
    e.querySelector("#btnAddComment").addEventListener('click', function(f){
        f.preventDefault();
        let firstname = this.dataset.username;
        let profile_picture = this.dataset.profilepicture;
        let postId = this.dataset.postid;
        let text = e.querySelector("#commentText").value;

        console.log(this.dataset);
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
                let text = document.createElement("p");
                let container = document.createElement("div");
                let profilePicture = document.createElement("img");
                let firstName = document.createElement("span");

                text.innerHTML = result.body;
                profilePicture.src = "profile_pictures/" + profile_picture;
                firstName.innerHTML = "- " + firstname;
                e.querySelector(".post__comments__list").appendChild(newComment);
                newComment.appendChild(container);
                container.appendChild(profilePicture);
                container.appendChild(firstName);
                newComment.appendChild(text);

                e.querySelector("#commentText").value = "";
            })
            .catch(error => {
                console.error("Error:", error);
            });


        let commentCount = parseInt(e.querySelector(".commentCount").innerHTML);
        commentCount++;
        e.querySelector('.commentCount').innerHTML = commentCount;
        // e.querySelector('.commentCount').innerHTML = "<?php echo count($allComments) + 1; ?>";
    });

    

    //triggers add button on enter
    e.querySelector("#commentText").addEventListener("keyup", function(f){
      if(f.keyCode === 13) {
          f.preventDefault();
          e.querySelector("#btnAddComment").click();
      }
    });
});