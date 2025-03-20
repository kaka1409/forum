const app = {
    components: {

        // side menu components
        "collapse_icon": document.querySelector('.collapse_icon'),
        "sidemenu": document.querySelector('.side_menu'),
        
        // post components
        "posts": Array.from(document.querySelectorAll('.post')),

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
            app.components['posts'].forEach((post) => {

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
                
                upvoteContainer.addEventListener('mouseover', () => {
                    const upvote = upvoteContainer.querySelector('.upvote_container img')
                    upvote.src = 'assets/icons/upvote_hover.png'
                })

                upvoteContainer.addEventListener('mouseout', () => {
                    const upvote = upvoteContainer.querySelector('.upvote_container img')
                    upvote.src = 'assets/icons/upvote.png'
                })

                // downvote events (hover)
                const downvoteContainer = post.querySelector('.downvote_container')

                downvoteContainer.addEventListener('mouseover', () => {
                    const downvote = downvoteContainer.querySelector('.downvote_container img')
                    downvote.src = 'assets/icons/downvote_hover.png'
                })

                downvoteContainer.addEventListener('mouseout', () => {
                    const downvote = downvoteContainer.querySelector('.downvote_container img')
                    downvote.src = 'assets/icons/downvote.png'
                })

            })
        },
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
                form.addEventListener('submit')

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
