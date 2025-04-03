import { selectElement, truncateText } from "./helpers.js";
import { rootURL, baseURL, iconsURL } from "./config.js"

// async function to handle upvote and downvote
const handleVote = async (postId, isUpvote) => {
    const endPoint = isUpvote ? 'post/upvote' : 'post/downvote';

    try {
        const response = await fetch(baseURL + endPoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'post_id=' + postId
        })

        const data = await response.json()

        // console.log(data)

        if (data && data.voteCount !== undefined) {

            const voteCountELement = selectElement(`[post-id="${postId}"] .vote_count`);
            if (voteCountELement) {
                voteCountELement.textContent = data.voteCount
            }

            // console.log(voteCountELement)
        }

        // Update vote button appearance
        const upvoteIcon = selectElement(`[post-id="${postId}"] #upvote`);
        const downvoteIcon = selectElement(`[post-id="${postId}"] #downvote`);
        
        // console.log(upvoteIcon, downvoteIcon)

        if (isUpvote) {
            upvoteIcon.src = upvoteIcon.src.includes('upvoted') ? iconsURL + 'upvote.png' : iconsURL + 'upvoted.png'
            downvoteIcon.src = iconsURL + 'downvote.png'
        } else {
            upvoteIcon.src = iconsURL + 'upvote.png'
            downvoteIcon.src = downvoteIcon.src.includes('downvoted') ? iconsURL + 'downvote.png' : iconsURL + 'downvoted.png'
        }

    } catch (error) {
        console.log(error)
    }
}

const handleComment = async (postId, commentContent) => {
    try {
        const response = await fetch(baseURL + 'post/comment', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({ 
                postId: postId,
                content: commentContent
            }),
        })

        const data = await response.json()
        console.log(data)

        if (data && data.content !== "") {
            // hide no comment message
            const message = selectElement('.comment_empty')
            message.style.display = 'none'

            const commentSection = selectElement('.comment_section')

            // create comment element
            const commentElement = document.createElement('div')
            commentElement.innerHTML = `
                <div class="comment">
                    <div class="comment_header">
                        <div class="thumbnail_container">
                            <img src="${rootURL + data.avatar}" alt="">
                        </div>
    
                        <div class="comment_username">
                            <h1>${data.username}</h1>
                            <div class="comment_date">
                                &bull; Just now
                            </div>
                        </div>
                    </div>    

                    <div class="comment_wraper">
                        <div class="branch_line_container"></div>

                        <div class="comment_main_container">
                            <div class="comment_content">
                               ${data.content}
                            </div>
            
                            <div class="comment_control">
                                <div class="comment_vote">
                                    <div class="upvote_container">
                                        <img id="upvote" src="${baseURL}/assets/icons/upvote.png" alt="">
                                        <p class="vote_count">0</p>
                                    </div>
                                    <div class="downvote_container">
                                        <img id="downvote" src="${baseURL}/assets/icons/downvote.png" alt="">
                                    </div>
                                </div>
        
                                <div class="post_comments">
                                    <div class="post_comments_container">
                                        <img src="${baseURL}/assets/icons/comment.png" alt="">
                                    </div>
                                </div>
                                <!-- <form action="<?= BASE_URL ?>post/reply" method="POST">
                                    <input type="text">
                                    <input id="post_comment" type="submit" name="submit" value="Post">
                                </form> -->
                            </div>
                        </div>

                    </div>
                </div>
            `

            // add it to the comment section
            commentSection.appendChild(commentElement)

        }

    } catch (error) {
        console.error("Failed to fetch comment data from server: ", error)
    }
}

const handleCommentVote = async (isupvote) => {
    const endPoint = isupvote ? 'post/comment/upvote' : 'post/comment/downvote'

    try {
        const response = await fetch(baseURL + endPoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({

            })
        })

        const data = await response.json()

        // todo

    } catch (error) {
        console.error("Failed to to fetch comment vote data from server ", error)
    }
}

const handleReply = async () => {
    // todo
}

const handleBookmark = async (postId) => {

    try {
        const response = await fetch(baseURL + 'post/bookmark', {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: 'post_id=' + postId
        })        

        const data = await response.json()

        // console.log(data)

    } catch (error) {
        console.error(error)
    }
}

const handleAdminControl = async (listType) => {
    const endPoint = 'admin/' + listType
    const title = `
        <h1 class="title">
            List of ${listType}
        </h1>
    `

    // element to display user data
    const listContent = selectElement('.admin_content .content')
    const list = selectElement('.list')
    list.innerHTML = ''

    if (list && listContent) {

        try {
            // get data
            const response = await fetch(baseURL + endPoint)
            const data = await response.json()
    
            if (data) {
                
                // switch between lists
                switch (listType) {

                    // List of post
                    case 'post': {
                        // module data
                        const posts = data.posts

                        posts.forEach(post => {
                            const postElement = document.createElement('li')
                            postElement.classList.add('item', 'post')

                            postElement.innerHTML = `
                                <div class="post_title">
                                    ${
                                        truncateText(post.title, 50)  
                                    }
                                </div>

                                <div class="post_author">
                                    ${post.account_name}
                                </div>

                                <div class="posted_date">
                                    ${post.post_at}
                                </div>

                                <div class="post_controls">
                                    <a href="${baseURL}post/${post.post_id}/edit">
                                        <img src="${baseURL}assets/icons/edit.png" alt="">
                                    </a>

                                    <form action="${baseURL}post/${post.post_id}/delete" method="POST">
                                        <button style="background-color: transparent; border: none;">
                                            <a href="${baseURL}post/${post.post_id}/delete">
                                                <img src="${baseURL}assets/icons/trash.png" alt="">
                                            </a>
                                        </button>
                                    </form>
                                </div>
                            `

                            list.appendChild(postElement)
                        })

                        // append add button to the end of the list
                        const addButton = document.createElement('a')
                        addButton.classList.add('btn', 'add_btn')
                        addButton.setAttribute('href', `${baseURL}post/create`)
                        addButton.textContent = '+ Add'
                        list.appendChild(addButton)

                        listContent.innerHTML = title + list.outerHTML
                        break;
                    }
                    
                    // List of modules
                    case 'module': {
                        // module data
                        const modules = data.modules

                        modules.forEach(module => {
                            const moduleElement = document.createElement('li')
                            moduleElement.classList.add('item', 'module')

                            moduleElement.innerHTML = `
                                <div class="module_name">
                                    ${module.module_name}
                                </div>
                                
                                <div class="module_teacher">
                                    ${module.teacher}
                                </div>

                                <div class="module_description">
                                    ${
                                        truncateText(module.description, 30)
                                    }
                                </div>

                                <div class="module_controls">
                                    <a href="${baseURL}admin/module/edit/${module.module_id}">
                                        <img 
                                            src="${baseURL}assets/icons/edit.png"  
                                            alt=""
                                        >
                                    </a>

                                    <form action="${baseURL}admin/module/delete/${module.module_id}" method="POST">
                                        <button style="background-color: transparent; border: none;">
                                            <a href="${baseURL}admin/module/delete/${module.module_id}">
                                                <img src="${baseURL}assets/icons/trash.png" alt="">
                                            </a>
                                        </button>
                                    </form>
                                </div> 
                            `

                            list.appendChild(moduleElement)
                        });

                        // append add button to the end of the list
                        const addButton = document.createElement('a')
                        addButton.classList.add('btn', 'add_btn')
                        addButton.setAttribute('href', `${baseURL}admin/module/create`)
                        addButton.textContent = '+ Add'
                        list.appendChild(addButton)

                        listContent.innerHTML = title + list.outerHTML
                        break;
                    }
                    
                    // List of users
                    case 'user': {
                        // user data
                        const users = data.users

                        //  load user data to userItem element
                        for (const user of users) {
                            const userItem = document.createElement('li')
                            userItem.classList.add('item', 'user')
            
                            userItem.innerHTML = `
                                <div class="user_details">
                                    <div class="user_avatar">
                                        <img 
                                            src="${ rootURL + user.account_avatar }" 
                                            alt=""
                                        >
                                    </div>
            
                                    <div class="username">
                                        ${user.account_name}
                                    </div>
                                </div>
            
                                <div class="user_role">
                                    ${user.role}
                                </div>
            
                                <div class="user_email">
                                    ${user.email}
                                </div>
            
                                <div class="user_create_date">
                                    created ${user.create_date}
                                </div>
            
                                <div class="user_controls">
                                    <a href="${baseURL}admin/user/edit/${user.account_id}">
                                        <img 
                                            src="${baseURL}assets/icons/edit.png"  
                                            alt=""
                                        >
                                    </a>

                                    <form action="${baseURL}admin/user/delete/${user.account_id}" method="POST">
                                        <button style="background-color: transparent; border: none;">
                                            <a href="${baseURL}admin/user/delete/${user.account_id}">
                                                <img src="${baseURL}assets/icons/trash.png" alt="">
                                            </a>
                                        </button>
                                    </form>
                                </div>
                            `

                            // add to list
                            list.appendChild(userItem)
                        }

                        // append add button to the end of the list
                        const addButton = document.createElement('a')
                        addButton.classList.add('btn', 'add_btn')
                        addButton.setAttribute('href', `${baseURL}admin/user/create`)
                        addButton.textContent = '+ Add'
                        list.appendChild(addButton)

                        listContent.innerHTML = title + list.outerHTML
                        break;
                    }
                    
                    // List of messages
                    case 'message': {

                        // todo

                        listContent.innerHTML = title + list.outerHTML
                        break;
                    }
                    
                    // undefined listType
                    default: {
                        adminContent.innerHTML = `
                            <h1 class="title">
                                No content
                            </h1>
                        `
                        break;
                    }
                }
            }
    
        } catch (error) {
            console.error(error)
        }
    }
}

export {
    handleVote,
    handleComment,
    handleBookmark,
    handleAdminControl
}