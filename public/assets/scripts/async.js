import { selectElement } from "./helpers.js";
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


    } catch (error) {
        console.error("Failed to to fetch comment vote data from server ", error)
    }
}

const handleReply = async () => {

}

export {
    handleVote,
    handleComment
}