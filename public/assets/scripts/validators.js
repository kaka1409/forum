import { selectElement } from "./helpers.js";
function loginFormValidator() {

}

function registerFormValidator() {

}

function createPostFormValidator() {
    const form = selectElement('#create_post_form')

    if (form) {
        const rules = {
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

        }

        // title
        const title = form.querySelector('.post_form #title')
        const titleCharCount = form.querySelector('.post_form #title_char_count')

        // thumbnail
        const thumbnailBtn = form.querySelector('.post_form .form_thumbnail')
        const thumbnailInput = form.querySelector('.post_form #thumbnail')
        const thumbnailPreview = form.querySelector('.post_form #thumbnail_preview')
        const thumbnailTitle = form.querySelector('.post_form .thumbnail_title')

        // content
        const content = form.querySelector('.post_form #content')
        const contentCharCount = form.querySelector('.post_form #content_char_count')

        if (title) {
            let titleMax = rules.title.maxCharacters
            titleCharCount.textContent = titleMax // display char limit

            const limitTitleChar = () => {
                // update character count
                let remainChar = titleMax - title.value.length
                titleCharCount.textContent = remainChar >= 0 ? remainChar : 0
                
                // limit title length
                if (title.value.length > titleMax) {
                    title.value = title.value.slice(0, titleMax)
                }
            }

            title.addEventListener('input', limitTitleChar)
        }

        if (thumbnailInput) {
            const selectFile = () => {
                thumbnailInput.click()
            }

            const previewImgFile = () => {
                thumbnailTitle.style.display = 'none'
                thumbnailPreview.style.display = 'block';
                thumbnailPreview.src = URL.createObjectURL(thumbnailInput.files[0])
            }

            thumbnailBtn.addEventListener('click', selectFile)

            thumbnailInput.addEventListener('change', previewImgFile)
        }

        if (content) {
            let contentMax = rules.content.maxCharacters
            contentCharCount.textContent = contentMax // display char limit

            const limitContentChar = () => {
                // update character count
                let remainChar = contentMax - content.value.length
                contentCharCount.textContent = remainChar >= 0 ? remainChar : 0
                
                // limit content length
                if (content.value.length > contentMax) {
                    content.value = content.value.slice(0, contentMax)
                }
            }

            content.addEventListener('input', limitContentChar)
        }
    }
}

function messageFormValidator() {

}


export {
    loginFormValidator,
    registerFormValidator,
    createPostFormValidator, 
    messageFormValidator

}