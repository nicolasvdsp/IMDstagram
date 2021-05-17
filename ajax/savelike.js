let postsL = document.querySelectorAll('.post');

postsL.forEach((e) => {
    e.querySelector("#btnAddLike").addEventListener('click', function(f){
        f.preventDefault();
        let postId = this.dataset.postid;
        let isLiked = this.dataset.isliked;

        console.log(postId);

        // post naar database (AJAX)
        let formData = new FormData();
        formData.append("postId", postId);
        formData.append("isLiked", isLiked);

        fetch("ajax/savelike.php", {
            method: "POST",
            body: formData
        });

        let likeCount = parseInt(e.querySelector(".likeCount").innerHTML);
        if(this.dataset.isliked == "false"){
            likeCount++;
            e.querySelector(".likeCount").innerHTML = likeCount;
            
            e.querySelector(".iconLike").src = "assets/icon_likes-toggled.svg";
            e.querySelector(".iconLike").style.width = "23px";
            this.dataset.isliked = "true";
        } else {
            likeCount--;
            e.querySelector(".likeCount").innerHTML = likeCount;
            
            e.querySelector(".iconLike").src = "assets/icon_likes.svg";
            this.dataset.isliked = "false";
        }
    });

});