const app = {
    components: {

        // side menu components
        "collapse_icon": document.querySelector('.collapse_icon'),
        "sidemenu": document.querySelector('.side_menu'),
        
        // create post form components
        "create_post_form": document.querySelector('.post_form form'),

        "module": document.querySelector('.post_form #module'),

        "title": document.querySelector('.post_form #title'),
        "title_char_count": document.querySelector('.post_form #title_char_count'),

        "thumbnailButton": document.querySelector('.post_form .form_thumbnail'),
        "thumbnail": document.querySelector('.post_form #thumbnail'),
        "thumbnailPreview": document.querySelector('.post_form #thumbnail-preview'),
        "thumbnailTitle": document.querySelector('.post_form .thumbnail_title'),

        "content": document.querySelector('.post_form #content'),
        "content_char_count": document.querySelector('.post_form #content_char_count'),

    },

    animation: {
        init: function() {
            // side menu collapse animation
            app.components['collapse_icon'].addEventListener('click', () => {
                app.components['sidemenu'].classList.toggle('collapsed')
            })
        }
    },

    createPostFormValidator: {
        rules: {
            module: {
                // required: true
            },

            title: {
                // required: true,
                maxCharacters: 100
            },

            thumbnail: {
                // required: true,
            },

            content: {
                // required: true,
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
                form.addEventListener('submit', (e) => {
                    e.preventDefault()

                    console.log(e.target)
                })

            }
        }        
    },

    start: function() {
        this.animation.init()
        this.createPostFormValidator.init()
    }
}


app.start()
