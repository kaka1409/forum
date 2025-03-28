import { selectElement } from "./helpers.js";
import { baseURL, iconsURL } from "./config.js"

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

            const voteCountELement = selectElement(`[post_id="${postId}"] .vote_count`);
            if (voteCountELement) {
                voteCountELement.textContent = data.voteCount
            }
        }

        // Update vote button appearance
        const upvoteIcon = selectElement(`[post_id="${postId}"] #upvote`);
        const downvoteIcon = selectElement(`[post_id="${postId}"] #downvote`);
        
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
            body: new URLSearchParams({ postId: postId, content: commentContent}),
        })

        const data = await response.json()
        console.log(data)

        if (data && data.content !== "") {
            const content = data.content
            const commentSection = selectElement('.comment_section')

            // create comment element
            const commentElement = document.createElement('div')
            commentElement.innerHTML = `
                
                <p>${content}</p>
            `

            // add it to the comment section
            commentSection.appendChild(commentElement)

        }

        

    } catch (error) {
        console.error("Failed to fetch data from server: ", error)
    }
}


const handleReply = async () => {

}

export {
    handleVote,
    handleComment
}