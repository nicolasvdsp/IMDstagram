/*document.querySelector("#loadBtn").addEventListener("click", function(){

    let postid = this.dataset.postid;
 
    console.log(postid);



    
});*/

$(document).ready(function(){
    $("#loadBtn").click(function(){
     loadmore();
    });
   });
   
   function loadmore()
   {
    var val = document.getElementById("result_no").value;
    $.ajax({
    type: 'post',
    url: 'index.php',
    data: {
     getresult:val
    },
    success: function (response) {
     var content = document.getElementById("posts");
     content.innerHTML = content.innerHTML+response;
   
     // We increase the value by 2 because we limit the results by 2
     document.getElementById("result_no").value = Number(val)+2;
    }
    });
   };