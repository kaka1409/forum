const app = {
    components: {

        // side menu components
        "collapse_icon": document.querySelector('.collapse_icon'),
        "sidemenu": document.querySelector('.side_menu'),
        
        // post's components
        "posts": Array.from(document.querySelectorAll('.post')), // get an array of posts
        "post": document.querySelector('.post_container'), // get a post when viewing a single post

        // create post form components
        "create_post_form": document.querySelector('.post_form form'),

        "module": document.querySelector('.post_form #module'),

        "title": document.querySelector('.post_form #title'),
        "title_char_count": document.querySelector('.post_form #title_char_count'),

        "thumbnailButton": document.querySelector('.post_form .form_thumbnail'),
        "thumbnail": document.querySelector('.post_form #thumbnail'),
        "thumbnailPreview": document.querySelector('.post_form #thumbnail_preview'),
        "thumbnailTitle": document.querySelector('.post_form .thumbnail_title'),

        "content": document.querySelector('.post_form #content'),
        "content_char_count": document.querySelector('.post_form #content_char_count'),

    },

    eventHandler: {
        init: function() {
            // side menu collapse event
            app.components['collapse_icon'].addEventListener('click', () => {
                app.components['sidemenu'].classList.toggle('collapsed')
            })

            // post's components events
            const posts = app.components['posts']
            
            /*
                if post listing exist (many posts is displayed) apply effect for posts component 
                if not then the user has to be in a post
            */ 
            if (posts.length != 0) {
                // console.log('yes')

                posts.forEach((post) => {
    
                    // post options events
                    const postOptions = post.querySelector('.post_options')
    
                    post.addEventListener('mouseover', () => {
                        postOptions.style.visibility = 'visible'
                    })
    
                    post.addEventListener('mouseout', () => {
                        postOptions.style.visibility = 'hidden'
                    })
    
                    // upvote events (hover)
                    const upvoteContainer = post.querySelector('.upvote_container')
                    const upvote = upvoteContainer.querySelector('.upvote_container img')
                    
                    upvoteContainer.addEventListener('mouseover', () => {
                        upvote.src = '/forum/public/assets/icons/upvote_hover.png'
                    })
    
                    upvoteContainer.addEventListener('mouseout', () => {
                        upvote.src = '/forum/public/assets/icons/upvote.png'
                    })
    
                    // downvote events (hover)
                    const downvoteContainer = post.querySelector('.downvote_container')
                    const downvote = downvoteContainer.querySelector('.downvote_container img')
    
                    downvoteContainer.addEventListener('mouseover', () => {
                        downvote.src = '/forum/public/assets/icons/downvote_hover.png'
                    })
    
                    downvoteContainer.addEventListener('mouseout', () => {
                        downvote.src = '/forum/public/assets/icons/downvote.png'
                    })
    
                    // comment icon hover effect
                    const commentIconContainer = post.querySelector('.post_comments')
                    const iconContainer = commentIconContainer.querySelector('.post_comments_container')
                    const commentIcon = commentIconContainer.querySelector('.post_comments_container img')
    
                    commentIconContainer.addEventListener('mouseover', () => {
                        iconContainer.style.backgroundColor = "rgba(44, 220, 230, 0.2)";
                        commentIcon.src = '/forum/public/assets/icons/comment_hover.png'
    
                    })
    
                    commentIconContainer.addEventListener('mouseout', () => {
                        iconContainer.style.backgroundColor = "transparent";
                        commentIcon.src = '/forum/public/assets/icons/comment.png'
                    })
    
                    // save icon hover effect
                    const saveIconContainer = post.querySelector('.post_save')
                    const saveIcon = saveIconContainer.querySelector('img')
    
                    saveIconContainer.addEventListener('mouseover', () => {
                        saveIcon.src = '/forum/public/assets/icons/save_hover.png'
                    })
    
                    saveIconContainer.addEventListener('mouseout', () => {
                        saveIcon.src = '/forum/public/assets/icons/save.png'
                    })
    
                    // share icon hover effect
                    const shareContainer = post.querySelector('.post_share')
                    const shareIcon = shareContainer.querySelector('img')
    
                    shareContainer.addEventListener('mouseover', () => {
                        shareIcon.src = '/forum/public/assets/icons/share_hover.png'
                    })
    
                    shareContainer.addEventListener('mouseout', () => {
                        shareIcon.src = '/forum/public/assets/icons/share.png'
                    })
    
                })
            } else {
                // console.log('no')

                const post = app.components['post']

                // post options events
                // const postOptions = post.querySelector('.post_options')
    
                // post.addEventListener('mouseover', () => {
                //     postOptions.style.visibility = 'visible'
                // })

                // post.addEventListener('mouseout', () => {
                //     postOptions.style.visibility = 'hidden'
                // })

                // upvote events (hover)
                const upvoteContainer = post.querySelector('.upvote_container')
                const upvote = upvoteContainer.querySelector('.upvote_container img')
                

                upvoteContainer.addEventListener('mouseover', () => {
                    upvote.src = '/forum/public/assets/icons/upvote_hover.png'
                })

                upvoteContainer.addEventListener('mouseout', () => {
                    upvote.src = '/forum/public/assets/icons/upvote.png'
                })

                // downvote events (hover)
                const downvoteContainer = post.querySelector('.downvote_container')
                const downvote = downvoteContainer.querySelector('.downvote_container img')

                downvoteContainer.addEventListener('mouseover', () => {
                    downvote.src = '/forum/public/assets/icons/downvote_hover.png'
                })

                downvoteContainer.addEventListener('mouseout', () => {
                    downvote.src = '/forum/public/assets/icons/downvote.png'
                })

                // comment icon hover effect
                const commentIconContainer = post.querySelector('.post_comments')
                const iconContainer = commentIconContainer.querySelector('.post_comments_container')
                const commentIcon = commentIconContainer.querySelector('.post_comments_container img')

                commentIconContainer.addEventListener('mouseover', () => {
                    iconContainer.style.backgroundColor = "rgba(44, 220, 230, 0.2)";
                    commentIcon.src = '/forum/public/assets/icons/comment_hover.png'

                })

                commentIconContainer.addEventListener('mouseout', () => {
                    iconContainer.style.backgroundColor = "transparent";
                    commentIcon.src = '/forum/public/assets/icons/comment.png'
                })

                // save icon hover effect
                const saveIconContainer = post.querySelector('.post_save')
                const saveIcon = saveIconContainer.querySelector('img')

                saveIconContainer.addEventListener('mouseover', () => {
                    saveIcon.src = '/forum/public/assets/icons/save_hover.png'
                })

                saveIconContainer.addEventListener('mouseout', () => {
                    saveIcon.src = '/forum/public/assets/icons/save.png'
                })

                // share icon hover effect
                const shareContainer = post.querySelector('.post_share')
                const shareIcon = shareContainer.querySelector('img')

                shareContainer.addEventListener('mouseover', () => {
                    shareIcon.src = '/forum/public/assets/icons/share_hover.png'
                })

                shareContainer.addEventListener('mouseout', () => {
                    shareIcon.src = '/forum/public/assets/icons/share.png'
                })

            }
        }
    },

    createPostFormValidator: {
        rules: {
            module: {
                required: true
            },

            title: {
                required: true,
                maxCharacters: 100
            },

            thumbnail: {
                required: false,
            },

            content: {
                required: true,
                maxCharacters: 1000
            }

        },

        postFormValidation: function() {
            const rules = this.rules
            
            // post title validation
            const title = app.components['title']
            const titleCharCount = app.components['title_char_count']
            
            titleMax = rules.title.maxCharacters
            titleCharCount.textContent = titleMax // display max characters to DOM

            title.addEventListener('input', () => {
                // update character count
                let remainChar = titleMax - title.value.length
                titleCharCount.textContent = remainChar >= 0 ? remainChar : 0
                
                // limit title length
                if (title.value.length > titleMax) {
                    title.value = title.value.slice(0, titleMax)
                }
            })
            
            // Post thumbnail events
            const thumbnailBtn = app.components['thumbnailButton']
            const thumbnailInput = app.components['thumbnail']
            const thumbnailPreview = app.components['thumbnailPreview']
            const thumbnailTitle = app.components['thumbnailTitle']

            thumbnailBtn.addEventListener('click', () => {
                thumbnailInput.click()
            })

            thumbnailInput.addEventListener('change', () => {
                thumbnailTitle.style.display = 'none'
                thumbnailPreview.style.display = 'block';
                thumbnailPreview.src = URL.createObjectURL(thumbnailInput.files[0])
            })

            // post content validation (similar to title validation)
            const content = app.components['content']
            const contentCharCount = app.components['content_char_count']

            contentMax = rules.content.maxCharacters
            contentCharCount.textContent = contentMax

            content.addEventListener('input', () => {
                // update character count
                let remainChar = contentMax - content.value.length
                contentCharCount.textContent = remainChar >= 0 ? remainChar : 0
                
                // limit content length
                if (content.value.length > contentMax) {
                    content.value = content.value.slice(0, contentMax)
                }
            })

        },

        init: function() {
            const form = app.components['create_post_form']

            if (form) {
                this.postFormValidation()
                // form.addEventListener('submit')

            }
        }        
    },

    loginFormValidator: {
        init: function() {
            
        }
    },

    registerFormValidator: {
        init: function() {
            
        }
    },

    start: function() {
        // login and register form validation
        this.loginFormValidator.init()
        this.registerFormValidator.init()

        this.eventHandler.init()
        this.createPostFormValidator.init()
    }
}


app.start()
