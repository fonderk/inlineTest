
let button = document.getElementsByClassName('button-download')[0].addEventListener("click",    function(){
    getAndInsertPosts();
    getAndInsertComments();
});

//search in db by comment
let buttonSeacrh = document.getElementsByClassName('button-search')[0].addEventListener("click",    function(){
    if(document.getElementsByClassName('input-search')[0].value.trim().length >= 3){
        searchPostsByComment(document.getElementsByClassName('input-search')[0].value);
    }
    else {
        alert('Минимум 3 символа!');
    }
});


//get posts from back
$.ajax({
    type: "GET",
    url: "http://ilkaskh8.beget.tech/app/Controllers/GetPosts.php",
    datatype: "json",
})
    .done(function(response) {
        //render posts
        renderPosts(response);
    });

//get and insert posts
function getAndInsertPosts(){
    fetch('https://jsonplaceholder.typicode.com/posts')
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            //send posts to back
            fetch('http://ilkaskh8.beget.tech/app/Controllers/InsertPosts.php', {
                method: 'POST',
                mode: 'no-cors',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then((response) => {
                if(response.status == 200){
                    console.log('Загружено '+ data.length +' записей и ');
                }
            });
        });
};

//get and insert commments
function getAndInsertComments(){
    fetch('https://jsonplaceholder.typicode.com/comments')
        .then((response) => {
            return response.json();
        })
        .then((data) => {
            //send comments to back
            fetch('http://ilkaskh8.beget.tech/app/Controllers/InsertCommetns.php', {
                method: 'POST',
                mode: 'no-cors',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then((response) => {
                if(response.status == 200){
                    console.log(data.length +' комментариев');
                }
            });
        });
}

//search post by comment
function searchPostsByComment(data){
    $.get("http://ilkaskh8.beget.tech/app/Controllers/SearchPostByComment.php", {comment: data} , function(data){
        // render posts and add comments
        data = JSON.parse(data);
        renderFromSearch(data)
    });
}

//render posts from get request
function renderPosts(response){
    const posts = document.getElementsByClassName('posts')[0];
    response.forEach(el=>{
        //create and add post div to posts div
        let post = document.createElement('div');
        post.className = "post";
        post.setAttribute('id',el.id);
        post.setAttribute('userId',el.userId);
        post.setAttribute('title',el.title);
        post.setAttribute('body',el.body);
        posts.appendChild(post);
        //add comment to post's body
        let postBody = document.createElement('div');
        postBody.className = "postTitle";
        postBody.innerHTML=el.title;
        post.appendChild(postBody);
    })
}

// render posts and add comments
function renderFromSearch(data){
    const postIds = data.map(a => a.postId);
    const posts = document.getElementsByClassName('post');
    //search posts that have desired comment
    Array.from(posts).forEach(element => {
        if(postIds.includes(element.getAttribute('id'))){
            for (var i = 0; i < data.length; i++) {
                if(data[i].postId == element.getAttribute('id')){
                    //create comment div and append comment text to it
                    let comment = document.createElement('div');
                    comment.className = "comment";
                    comment.innerHTML = data[i].commentBody;
                    element.appendChild(comment);
                }
            }
            element.classList.remove("hidden");
        }
        else {
            element.classList.add("hidden");
        }
    });
}
