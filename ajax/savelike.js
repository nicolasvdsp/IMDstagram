let postsL = document.querySelectorAll('.post');


postsL.forEach((e) => {
    let hoverBubble = e.querySelector(".hoverBubble");
    let likeCount = e.querySelector(".likeCount")
    
    e.querySelector("#btnAddLike").addEventListener('click', function(f){
        f.preventDefault();
        let postId = this.dataset.postid;
        let isLiked = this.dataset.isliked;
        let firstname = this.dataset.username;

        console.log(postId);

        // post naar database (AJAX)
        let formData = new FormData();
        formData.append("postId", postId);
        formData.append("isLiked", isLiked);

        fetch("ajax/savelike.php", {
            method: "POST",
            body: formData
        });
        
        let likeCounter = parseInt(likeCount.innerHTML);
        
        if(this.dataset.isliked == "false"){
            likeCounter++;
            likeCount.innerHTML = likeCounter;
            
            e.querySelector(".iconLike").src = "assets/icon_likes-toggled.svg";
            e.querySelector(".iconLike").style.width = "23px";
            this.dataset.isliked = "true";

            let newHoverBubbleText = document.createElement("li");
            newHoverBubbleText.setAttribute("data-likeuserid", "current-user");
            newHoverBubbleText.innerHTML = firstname;
            hoverBubble.appendChild(newHoverBubbleText);
        } else {
            likeCounter--;
            likeCount.innerHTML = likeCounter;
            
            e.querySelector(".iconLike").src = "assets/icon_likes.svg";
            this.dataset.isliked = "false";

            let currentUser = hoverBubble.querySelector("[data-likeuserid='current-user']");
            currentUser.remove();  
        }
        
        if(likeCount.innerHTML == 0){
            hoverBubble.classList.add("hide");
        } else{
            hoverBubble.classList.remove("hide");
        }
    });
    
    if(likeCount.innerHTML == 0){
        hoverBubble.classList.add("hide");
    }

});