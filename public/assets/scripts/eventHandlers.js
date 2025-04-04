import { selectElement, getPostIdInList } from "./helpers.js"
import { baseURL, iconsURL } from "./config.js"
import {
    handleVote,
    handleComment,
    handleBookmark,
    handleAdminControl 
} from "./async.js"


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

function handleWindowEvent() {

    // get list content element
    const listContent = selectElement('.admin_area .content')

    //  split url so we can get the list type
    const listURL = window.location.href.split('/').at(-1)

    if (listURL.includes('list')) {
        const listType = listURL.split('_')[0]

        const controlButton = selectElement(`.admin_controls [list-type="${listType}"]`)

        setTimeout(() => {
            // console.log(controlButton)
            controlButton.click()
        }, 50)

        // switch (listType) {
        //     case 'post': {
        //         listContent.innerHTML = window.history.state
        //         break
        //     }
    
        //     case 'module': {
        //         listContent.innerHTML = window.history.state
        //         break
        //     }
    
        //     case 'user': {
        //         listContent.innerHTML = window.history.state
        //         break
        //     }
    
        //     case 'message': {
        //         listContent.innerHTML = window.history.state
        //         break
        //     }
        // }
    }
}

function handleDOMEvent() {
    // hidden all popup when the user click on the document
    const popupHidden = () => {
        const popups = selectElement('.options_popup')
        // console.log(popups)

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

function handleSearchBarEvent() {
    const searchBar = selectElement('.search_bar')

    if (searchBar) {
        const searchInput = searchBar.querySelector('#search_input')

        const searchInputFocus = () => {
            searchBar.style.border = '0.5px solid #d78adb'
        }

        const searchInputNoFocus = () => {
            searchBar.style.border = 'none'
        }

        searchInput.addEventListener('focus', searchInputFocus)
        searchInput.addEventListener('blur', searchInputNoFocus)
    }
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

    let posts = selectElement('.posts_container .post')
    if (posts === undefined) return
    if (!Array.isArray(posts)) posts = new Array(posts)

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

        // upvote container
        const upvoteContainer = post.querySelector('.upvote_container')

        // downvote container
        const downvoteContainer = post.querySelector('.downvote_container')

        // comment container 
        const commentIconContainer = post.querySelector('.post_comments')
        
        // save container
        const saveIconContainer = post.querySelector('.post_save')

        // share container 
        const shareContainer = post.querySelector('.post_share')

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
            // upvote icon
            const upvote = upvoteContainer.querySelector('.upvote_container img')

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
    
                const postId = getPostIdInList(e)
                await handleVote(postId, true)
            }

            // event listener
            upvoteContainer.addEventListener('mouseover', upvoteMouseOver)
            upvoteContainer.addEventListener('mouseout', upvoteMouseOut)
            upvoteContainer.addEventListener('click', upvoteClicked)
        }

        if (downvoteContainer) {
            // downvote icon
            const downvote = downvoteContainer.querySelector('.downvote_container img')

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
    
                const postId = getPostIdInList(e)
                await handleVote(postId, false)
            }
            
            // event listeners
            downvoteContainer.addEventListener('mouseover', downvoteMouseOver)
            downvoteContainer.addEventListener('mouseout', downvoteMouseOut)
            downvoteContainer.addEventListener('click', downvoteClicked)
        }

        if (commentIconContainer) {
            // comment icon
            const commentIcon = commentIconContainer.querySelector('.post_comments_container img')

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
            // save icon
            const saveIcon = saveIconContainer.querySelector('img')

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

            const saveIconClicked = async (e) => {
                e.preventDefault()
                e.stopPropagation()
    
                if (!isLoggedIn) {
                    modalAppear()
                    return
                } 

                saveIcon.src = saveIcon.src.includes('saved') ? iconsURL + 'save.png' : iconsURL + 'saved.png'

                const postId = getPostIdInList(e)
                await handleBookmark(postId)                
            }

            // Event listener
            saveIconContainer.addEventListener('mouseover', saveIconMouseOver)
            saveIconContainer.addEventListener('mouseout', saveIconMouseOut)
            saveIconContainer.addEventListener('click', saveIconClicked)

        }

        if (shareContainer) {
            // share icon
            const shareIcon = shareContainer.querySelector('img')

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

            const saveIconClicked = (e) => {
                if (!isLoggedIn) {
                    modalAppear()
                    return
                }

                saveIcon.src = iconsURL + 'saved.png'

                console.log(e.target)
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

function handleModuleEvent() {
    const moduleWrapers = selectElement('.module_border')
    const gradients = [
        '#008CFF', '#FF0099',
        '#FF7700', '#FF00EE',
        '#2F00FF', '#FF0004',
        '#FF0000', '#F6FF00'
    ]
    let cur = 0, next = 1
    
    // anim config
    let duration = 0
    let delay = 1000

    if (moduleWrapers) {
        moduleWrapers.forEach( (wraper) => {
            if (next > gradients.length)  cur = 0, next = 1
            
            // set background to linear gradient
            wraper.style.backgroundImage = `linear-gradient(to right bottom, ${gradients[cur]}, ${gradients[next]})`
            cur++, next++
    
            // module anim
            duration += delay
            wraper.animate(
                [
                    {opacity: '0'},
                    {opacity: '1'}
                ],
                
                {
                    duration: duration,
                    easing: 'ease-in-out'
                }
            )
        })
    }
}

function handleMessageEvent() {
    const messages = selectElement('.message')

    if (messages) {

        // animation config
        let animDuration = 750
        let delay = 250

        messages.forEach(message => {
            animDuration += delay

            message.animate(
                [
                    {transform: 'translateX(10em)', opacity: 0},
                    {transform: 'translateX(0)', opacity: 1}
                ],

                {
                    duration:  animDuration,
                    easing: 'ease-in-out'
                }

            )
        })
    }
}

function handleAdminEvent() {
    const controlElements = selectElement('.control')

    if (controlElements !== undefined) {

        controlElements.forEach( (element) => {
            const controlElementClicked = async () => {
                const listType = element.getAttribute('list-type')

                await handleAdminControl(listType)
                
                handleListItemsEvent()
            }

            element.addEventListener('click', controlElementClicked)
        })
    }
}

function handleListItemsEvent() {
    // list items
    const items = selectElement('.list > .item')

    // add button
    const addButton = selectElement('.add_btn')

    // slide animation config
    let animDuration = 1000
    let delay = 200

    if (items) {
        items.forEach( (item) => {
            // item animation
            animDuration += delay
            item.animate(
                [
                    {transform: 'translateX(100%)', opacity: '0'},
                    {transform: 'translateX(0)', opacity: '1'}
                ],

                {
                    duration: animDuration,
                    easing: 'ease-in-out'
                }
            )
        })

        if (addButton) {
            addButton.animate(
                [
                    {opacity: '0'},
                    {opacity: '1'}
                ],
    
                {
                    duration: animDuration + delay,
                    easing: 'ease-in-out'
                }
            )
        }
    }
}

function handleCreateUserFormEvent() {
    const createUserForm = selectElement('#create_user_form')

    if (createUserForm) {
        const avatarContainer = createUserForm.querySelector('.avatar_container') 
        const avatarPlaceholder = avatarContainer.querySelector('.avatar_placeholder')
        const avatarFile = avatarContainer.querySelector('input')
        const avatarPreview = avatarContainer.querySelector('.avatar_preview')

        avatarContainer.addEventListener('click', () => {
            avatarFile.click()
        })

        avatarFile.addEventListener('change', () => {
            avatarPlaceholder.style.display = 'none'
            avatarPreview.style.display = 'block'
            avatarPreview.src = URL.createObjectURL(avatarFile.files[0])

            // console.log(avatarFile.files[0].name)
        })
    }

}

export {
    handleWindowEvent,
    handleDOMEvent,
    handleSearchBarEvent,
    handleSidemenuEvent,
    handlePostsEvents, 
    handlePostViewEvents,
    handleModuleEvent,
    handleMessageEvent,
    handleAdminEvent,
    handleCreateUserFormEvent
}