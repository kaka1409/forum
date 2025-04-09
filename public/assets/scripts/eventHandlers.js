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

    //  split url so we can get the list type
    const listURL = window.location.href.split('/').at(-1)

    if (listURL.includes('list')) {
        const listType = listURL.split('_')[0]

        const controlButton = selectElement(`.admin_controls [list-type="${listType}"]`)

        setTimeout(() => {
            // console.log(controlButton)
            controlButton.click()
        }, 50)
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

        const feedOptionPopup = selectElement('.feed_options')

        if (feedOptionPopup) {
            if (!feedOptionPopup.classList.contains('hidden')) {
                feedOptionPopup.classList.add('hidden')
            }
        }

    }

    document.addEventListener('click', popupHidden)

}

function handleSearchBarEvent() {
    const searchBar = selectElement('.search_bar')

    if (searchBar) {

        // search input
        const searchInput = searchBar.querySelector('#search_input')
        
        // search options
        const searchOption = searchBar.querySelector('.search_option')
        const fontStyle = window.getComputedStyle(searchInput).font;
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");
        context.font = fontStyle

        // reset search input
        const resetSearchIcon = searchBar.querySelector('.reset_search')
    
        // event functions
        const searchInputFocus = () => {
            searchBar.style.border = '0.5px solid #d78adb'

            // display
            resetSearchIcon.style.visibility = 'visible'
        }

        const searchInputNoFocus = () => {
            searchBar.style.border = 'none'

            // hidden
            searchOption.style.visibility = 'hidden'
            resetSearchIcon.style.visibility = 'hidden'
        }


        const searchInputChange = () => {
            const textWidth = context.measureText(searchInput.value).width

            if (parseInt(textWidth) <= (searchInput.parentElement.clientWidth - 50)) {
                searchOption.style.left = 60 + textWidth + 'px'
            }

            if (searchOption.style.visibility === '' || 'hidden') {
                searchOption.style.visibility = 'visible'
            }

            if (searchInput.value.trim() === '') {
                searchOption.style.visibility = 'hidden'
            }

        }

        const postSearch = 'search post'
        const userSearch = 'search user'
        const optionClicked = (e) => {
            e.preventDefault()
            e.stopPropagation()

            searchOption.animate(
                [
                    {
                        transform: 'scale(1)',
                        opacity: 1
                    },

                    {
                        transform: 'scale(0.7)',
                        opacity: 0.2
                    },

                    {
                        transform: 'scale(1)',
                        opacity: 1
                    },
                ],

                {
                    duration: 300,
                    easing: 'ease-in'
                }
            )

            searchOption.textContent  = searchOption.textContent.replace(/^\s+|\s+$/g, "") === postSearch ? userSearch : postSearch

        }

        const resetIconClicked = (e) => {
            e.preventDefault()
            e.stopPropagation()

            searchInput.value = ''
            searchInput
            searchOption.style.left = '60px'

            // hide search option
            searchOption.style.visibility = 'hidden'
        }

        // event listeners

        // search input
        searchInput.addEventListener('focus', searchInputFocus)
        searchInput.addEventListener('blur', searchInputNoFocus)
        searchInput.addEventListener('input', searchInputChange)

        // search option
        searchOption.addEventListener('mousedown', optionClicked)

        // reset search icon
        resetSearchIcon.addEventListener('mousedown', resetIconClicked)


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

function handleFeedSettingEvent() {

    // feed setting
    const feedSetting = selectElement('.feed_settings')

    // feed option container
    const feedOptions = selectElement('.feed_options')
    
    if (feedSetting) {
        const options = feedOptions.querySelectorAll('.options .option')
        
        const feedSettingClicked = (e) => {
            e.preventDefault()
            e.stopPropagation()

            // options anim config
            let duration = 200
            let delay = 100
            
            // toggle feed options
            feedOptions.classList.toggle('hidden')
            
            if (feedOptions.classList.contains('hidden')) {

                // hide feed options
                feedOptions.style.visibility = 'hidden'

                options.forEach(option => {
                    duration += delay
    
                    // feed options animation
                    option.animate(
                        [
                            {transform: 'translateX(0)'},
                            {transform: 'translateX(-15em)'},
                        ],
                        
                        {
                            duration: duration,
                            easing: 'ease-in-out'
                        }
                    )

                })

            } else {
                
                // make feed option visible
                feedOptions.style.visibility = 'visible'

                options.forEach(option => {
                    duration += delay
    
                    // feed options animation
                    option.animate(
                        [
                            {transform: 'translateX(-10em)'},
                            {transform: 'translateX(0)'},
                        ],
                        
                        {
                            duration: duration,
                            easing: 'ease-in-out'
                        }
                    )
                })
            }
        }

        
        feedSetting.addEventListener('click', feedSettingClicked)

    }

    if (feedOptions) {
        const options = feedOptions.querySelectorAll('.options .option')

        // get current location
        const currentLocation = window.location.href.split('?')[0]

        // create new search query string
        const urlParams = new URLSearchParams(window.location.search)

        // get setting from url query string and local storage
        const urlParamSetting = urlParams.get('feed')
        const localSetting = localStorage.getItem('feedSetting')

        //  synchorize setting between search params and local storage
        if (localSetting !== urlParamSetting) {
            window.history.pushState(null, '', `${currentLocation}?feed=${localSetting}`)
            window.location.reload()
        }

        const setting = localSetting || urlParamSetting || 'new'

        options.forEach( (option) => {
            const optionText = option.textContent.split(' ')[1] || option.textContent

            if (setting === optionText) {
                option.classList.add('selected')
                option.textContent = '✔ ' + option.textContent
            } else {
                option.classList.remove('selected')
            }

            const optionClicked = () => {

                // save setting to local storerage
                localStorage.setItem('feedSetting', optionText)

                // redirect 
                window.location.href = `${currentLocation}?feed=${localSetting}`
            }

            option.addEventListener('click', optionClicked)
        })
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
    let messages = selectElement('.message')
    if (messages === undefined) return
    if (!Array.isArray(messages)) messages = new Array(messages)

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

}

export {
    handleWindowEvent,
    handleDOMEvent,
    handleSearchBarEvent,
    handleSidemenuEvent,
    handleFeedSettingEvent,
    handlePostsEvents, 
    handlePostViewEvents,
    handleModuleEvent,
    handleMessageEvent,
    handleAdminEvent,
    handleCreateUserFormEvent
}