let posts = document.querySelectorAll('.post');
console.log(posts);

let btnAddComment = document.querySelectorAll("#btnAddComment");
let commentText = document.querySelectorAll("#commentText");

posts.forEach((e) => {
    e.querySelector("#btnAddComment").addEventListener('click', function(f){
        f.preventDefault();
        let postId = this.dataset.postid;
        let text = e.querySelector("#commentText").value;
    
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
                e.querySelector(".post__comments__list").appendChild(newComment);
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


//btnAddComment.addEventListener('click', addComment);
// commentText.addEventListener("keyup", function(e){
//   if(e.keyCode === 13) {
//       e.preventDefault();
//       document.querySelector("#btnAddComment").click();
//   }
// });

// function addComment() {
//     let postId = this.dataset.postid;
//     let text = document.querySelector("#commentText").value;

//     console.log(postId);
//     console.log(text);

//     // post naar database (AJAX)
//     let formData = new FormData();
//     formData.append("text", text);
//     formData.append("postId", postId);

//     fetch("ajax/savecomment.php", {
//         method: "POST",
//         body: formData
//     })
//         .then(response => response.json())
//         .then(result => {
//             let newComment = document.createElement("li");
//             newComment.innerHTML = result.body;
//             document.querySelector(".post__comments__list").appendChild(newComment);
//             document.querySelector("#commentText").value = "";
//         })
//         .catch(error => {
//             console.error("Error:", error);
//         });
// };








// let posts = document.querySelector('.posts');


// posts.forEach((post) => {
  
//   let btnAddComment = post.querySelector("#btnAddComment");
//   let commentText = post.querySelector("#commentText");


//     btnAddComment.addEventListener('click', addComment);
//     commentText.addEventListener("keyup", function(e){
//       if(e.keyCode === 13) {
//           e.preventDefault();
//           post.querySelector("#btnAddComment").click();
//       }
//     });

//     function addComment() {
//         let postId = this.dataset.postid;
//         let text = post.querySelector("#commentText").value;

//         console.log(postId);
//         console.log(text);

//         // post naar database (AJAX)
//         let formData = new FormData();
//         formData.append("text", text);
//         formData.append("postId", postId);

//         fetch("ajax/savecomment.php", {
//             method: "POST",
//             body: formData
//         })
//             .then(response => response.json())
//             .then(result => {
//                 let newComment = post.createElement("li");
//                 newComment.innerHTML = result.body;
//                 post.querySelector(".post__comments__list").appendChild(newComment);
//                 post.querySelector("#commentText").value = "";
//             })
//             .catch(error => {
//                 console.error("Error:", error);
//             });
//     };
// });