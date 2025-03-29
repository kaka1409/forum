import { selectElement } from "./helpers.js"
import { baseURL, iconsURL } from "./config.js"
import { handleVote, handleComment } from "./async.js"

function modalAppear() {
    const modal = selectElement('.modal.auth')

    if (modal) {

        const modalExitButton = modal.querySelector('img')
        modalExitButton.addEventListener('click', () => {
            modal.style.display = 'none'
        })

        // display style changed to flex
        modal.style.display = 'flex'
    }

}

function handleDOMEvent() {
    // hidden all popup when the user click on the document
    const popupHidden = () => {
        const popups = selectElement('.options_popup')
        if (popups) {
            popups.forEach( (popup) => {
                if (!popup.classList.contains('hidden')) {
                    popup.classList.add('hidden')
                }
            })
        }
    }

    document.addEventListener('click', popupHidden)
}

function handleSidemenuEvent() {
    const sidemenu = selectElement('.side_menu')

    if (sidemenu) {
        // sidemenu's elements
        const collapseIcon = sidemenu.querySelector('.collapse_icon')
        const newPostBtn = sidemenu.querySelector('.new_btn')

        // event functions
        const sidemenuCollapsed = () => {
            sidemenu.classList.toggle('collapsed')
        }

        const loginAuth = () => {
            if (!isLoggedIn) {
                modalAppear()
                return
            } 
        }

        // event listeners
        collapseIcon.addEventListener('click', sidemenuCollapsed)
        newPostBtn.addEventListener('click', loginAuth)
    }
}

function handlePostsEvents () {

    const posts = selectElement('.post')
    if (posts === undefined) return

    // post animation config
    let animDuration = 1200
    let delay = 200

    posts.forEach(post => {

        // post scale up animation
        animDuration += delay
        post.animate(
            [
                { transform: 'scale(0)', opacity: '0.25' },
                { transform: 'scale(1.1)'},
                { transform: 'scale(1)', opacity: '1'  }
            ],

            {
                duration: animDuration,
                easing: 'ease-in-out'
            }
        )

        // all post's element
        // popup
        const popup = post.querySelector('.options_popup')

        // upvote icon
        const upvoteContainer = post.querySelector('.upvote_container')
        const upvote = upvoteContainer.querySelector('.upvote_container img')

        // downvote icon
        const downvoteContainer = post.querySelector('.downvote_container')
        const downvote = downvoteContainer.querySelector('.downvote_container img')

        // save icon
        const saveIconContainer = post.querySelector('.post_save')
        const saveIcon = saveIconContainer.querySelector('img')

        // comment icon 
        const commentIconContainer = post.querySelector('.post_comments')
        const commentIcon = commentIconContainer.querySelector('.post_comments_container img')

        // share icon 
        const shareContainer = post.querySelector('.post_share')
        const shareIcon = shareContainer.querySelector('img')

        if (popup) {
            // post options 
            const postOptions = post.querySelector('.post_options')

            // a tag in post options
            const items = popup.querySelectorAll('a')

            // delete button in post's options event
            const deleteBtn = post.querySelector('#delete_btn')
            const confirmation = post.querySelector('.delete_confirmation')
            const exitBtn = post.querySelector('.delete_confirmation img')

            // events functions of elements
            const postOptionsVisible = () => {
                postOptions.style.visibility = 'visible'
            }

            const postOptionsHidden = () => {
                postOptions.style.visibility = 'hidden'
            }

            const popupToggle = (e) => {
                e.preventDefault()
                e.stopPropagation()
                
                if (popup.classList.contains('hidden')) {
                    popup.classList.remove('hidden')
                } else {
                    popup.classList.add('hidden')
                }
            }

            const itemsHidden = () => {
                popup.classList.add('hidden')
            }

            const confirmationAppear = (e) => {
                e.preventDefault()
                confirmation.style.display = 'flex'
            }

            const confirmationDisappear = () => {
                confirmation.style.display = 'none'
            }

            // post hovered will make the post option appear
            post.addEventListener('mouseover', postOptionsVisible)
            post.addEventListener('mouseout', postOptionsHidden)
            
            // post options clicked will toggle the popup
            postOptions.addEventListener('click', popupToggle)
            
            //  option item if clicked will be hidden
            items.forEach( (item) => {
                item.addEventListener('click', itemsHidden)
            })
            
            // click will make the confimation appear
            deleteBtn.addEventListener('click', confirmationAppear)

            exitBtn.addEventListener('click', confirmationDisappear)
        }
        
        if (upvoteContainer) {
            // event functions
            const upvoteMouseOver = () => {
                if (!upvote.src.includes('upvoted')) {
                    upvote.src = iconsURL + 'upvote_hover.png'
                }
            }

            const upvoteMouseOut = () => {
                if (!upvote.src.includes('upvoted')) {
                    upvote.src = iconsURL + 'upvote.png'
                }
            }

            const upvoteClicked = async (e) => {
                e.preventDefault()
                e.stopPropagation()

                if (!isLoggedIn) {
                    modalAppear()
                    return 
                }
    
                const postId = upvoteContainer.getAttribute('post-id')
                await handleVote(postId, true)
            }

            // event listener
            upvoteContainer.addEventListener('mouseover', upvoteMouseOver)
            upvoteContainer.addEventListener('mouseout', upvoteMouseOut)
            upvoteContainer.addEventListener('click', upvoteClicked)
        }

        if (downvoteContainer) {
            // event functions
            const downvoteMouseOver = () => {
                if (!downvote.src.includes('downvoted')) {
                    downvote.src = iconsURL + 'downvote_hover.png'
                }
            }

            const downvoteMouseOut = () => {
                if (!downvote.src.includes('downvoted')) {
                    downvote.src = iconsURL + 'downvote.png'
                }
            }

            const downvoteClicked = async (e) => {
                e.preventDefault()
                e.stopPropagation()

                if (!isLoggedIn) {
                    modalAppear()
                    return;
                } 
    
                const postId = downvoteContainer.getAttribute('post-id')
                await handleVote(postId, false)
            }
            
            // event listeners
            downvoteContainer.addEventListener('mouseover', downvoteMouseOver)
            downvoteContainer.addEventListener('mouseout', downvoteMouseOut)
            downvoteContainer.addEventListener('click', downvoteClicked)
        }

        if (commentIconContainer) {
            // event functions
            const commentIconMouseOver = () => {
                commentIcon.src = iconsURL + 'comment_hover.png'
            }

            const commentIconMouseOut = () => {
                commentIcon.src = iconsURL + 'comment.png'
            }

            // event listeners
            commentIconContainer.addEventListener('mouseover', commentIconMouseOver)
            commentIconContainer.addEventListener('mouseout', commentIconMouseOut)
        }

        if (saveIconContainer) {
            // event function
            const saveIconMouseOver = () => {
                if (!saveIcon.src.includes('saved')) {
                    saveIcon.src = iconsURL + 'save_hover.png'
                }
            }

            const saveIconMouseOut =  () => {
                if (!saveIcon.src.includes('saved')) {
                    saveIcon.src = iconsURL + 'save.png'
                }
            }

            const saveIconClicked = (e) => {
                e.preventDefault()
                e.stopPropagation()
    
                if (!isLoggedIn) {
                    modalAppear()
                    return
                } 
                saveIcon.src = iconsURL + 'saved.png'
            }

            // Event listener
            saveIconContainer.addEventListener('mouseover', saveIconMouseOver)
            saveIconContainer.addEventListener('mouseout', saveIconMouseOut)
            saveIconContainer.addEventListener('click', saveIconClicked)

        }

        if (shareContainer) {
            // event function
            const shareIconMouseOver = () => {
                shareIcon.src = iconsURL + 'share_hover.png'
            }

            const shareIconMouseOut = () => {
                shareIcon.src = iconsURL + 'share.png'
            }

            const shareIconClicked = (e) => {
                e.preventDefault()
                e.stopPropagation()
    
                if (!isLoggedIn) {
                    modalAppear()
                    return
                }
            }

            // Event listner
            shareContainer.addEventListener('mouseover', shareIconMouseOver)
            shareContainer.addEventListener('mouseout', shareIconMouseOut)
            shareContainer.addEventListener('click', shareIconClicked)
        }

    });
}

function handlePostViewEvents () {
    const post = selectElement('.post_container')

    if (post) {
        // upvote
        const upvoteContainer = post.querySelector('.upvote_container')
        const upvote = upvoteContainer.querySelector('.upvote_container img')
        
        // downvote
        const downvoteContainer = post.querySelector('.downvote_container')
        const downvote = downvoteContainer.querySelector('.downvote_container img')
    
        // comment icon 
        const commentIconContainer = post.querySelector('.post_comments')
        const commentIcon = commentIconContainer.querySelector('.post_comments_container img')
    
        // save icon 
        const saveIconContainer = post.querySelector('.post_save')
        const saveIcon = saveIconContainer.querySelector('img')
    
        // share icon 
        const shareContainer = post.querySelector('.post_share')
        const shareIcon = shareContainer.querySelector('img')

        // comment input
        const commentInput = post.querySelector('#comment')
        const commentButton = post.querySelector('#post_comment')

        if (upvoteContainer) {
            const upvoteMouseOver = () => {
                if (!upvote.src.includes('upvoted')) {
                    upvote.src = iconsURL + 'upvote_hover.png'
                }
            }
        
            const upvoteMouseOut = () => {
                if (!upvote.src.includes('upvoted')) {
                    upvote.src = iconsURL + 'upvote.png'
                }
            }

            const upvoteClicked = async () => {
                if (!isLoggedIn) {
                    modalAppear()
                    return
                }

                const postId = upvoteContainer.getAttribute('post-id')
                await handleVote(postId, true)
            }

            // Event listeners
            upvoteContainer.addEventListener('mouseover', upvoteMouseOver)
            upvoteContainer.addEventListener('mouseout', upvoteMouseOut)
            upvoteContainer.addEventListener('click', upvoteClicked)
        }

        if (downvoteContainer) {
            const downvoteMouseOver = () => {
                if (!downvote.src.includes('downvoted')) {
                    downvote.src = iconsURL + 'downvote_hover.png'
                }
            }
        
            const downvoteMouseOut = () => {
                if (!downvote.src.includes('downvoted')) {
                    downvote.src = iconsURL + 'downvote.png'
                }
            }

            const downvoteClicked = async () => {
                if (!isLoggedIn) {
                    modalAppear()
                    return
                }

                const postId = upvoteContainer.getAttribute('post-id')
                await handleVote(postId, false)
            }
        
            downvoteContainer.addEventListener('mouseover', downvoteMouseOver)
            downvoteContainer.addEventListener('mouseout', downvoteMouseOut)
            downvoteContainer.addEventListener('click', downvoteClicked)
        }

        if (commentIconContainer) {
            const commentIconMouseOver = () => {
                commentIcon.src = iconsURL + 'comment_hover.png'
            }
        
            const commentIconMouseOut = () => {
                commentIcon.src = iconsURL + 'comment.png'
            }

            const commentIconClicked = () => {
                if (!isLoggedIn) {
                    modalAppear()
                    return
                }
            }

            commentIconContainer.addEventListener('mouseover', commentIconMouseOver)
            commentIconContainer.addEventListener('mouseout', commentIconMouseOut)
            commentIconContainer.addEventListener('click', commentIconClicked)
        }
    
        if (saveIconContainer) {
            const saveIconMouseOver = () => {
                if (!saveIcon.src.includes('saved')) {
                    saveIcon.src = iconsURL + 'save_hover.png'
                }
            }
        
            const saveIconMouseOut = () => {
                if (!saveIcon.src.includes('saved')) {
                    saveIcon.src = iconsURL + 'save.png'
                }
            }

            const saveIconClicked = () => {
                if (!isLoggedIn) {
                    modalAppear()
                    return
                }

                saveIcon.src = iconsURL + 'saved.png'
            }

            saveIconContainer.addEventListener('mouseover', saveIconMouseOver)
            saveIconContainer.addEventListener('mouseout', saveIconMouseOut)
            saveIconContainer.addEventListener('click', saveIconClicked)
        }

        if (shareContainer) {
            const shareIconMouseOver = () => {
                shareIcon.src = iconsURL + 'share_hover.png'
            }
        
            const shareIconMouseOut = () => {
                shareIcon.src = iconsURL + 'share.png'
            }

            const shareIconClicked = () => {
                if (!isLoggedIn) {
                    modalAppear()
                    return
                }
            }

            shareContainer.addEventListener('mouseover', shareIconMouseOver)
            shareContainer.addEventListener('mouseout', shareIconMouseOut)
            shareContainer.addEventListener('click', shareIconClicked)
        }

        if (commentInput) {
            const commentButtonClicked = async () => {
                if (!isLoggedIn) {
                    modalAppear()
                    return
                }

                const postId = commentButton.getAttribute('post-id')
                await handleComment(postId, commentInput.value)

                // reset input
                commentInput.value = ''
            }


            commentButton.addEventListener('click', commentButtonClicked)

        }

    }
}


export {
    handleDOMEvent,
    handleSidemenuEvent,
    handlePostsEvents, 
    handlePostViewEvents
}