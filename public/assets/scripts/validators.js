import { baseURL } from "./config.js";
import { selectElement } from "./helpers.js";

function Validator(formSelector) {

    const form = selectElement(formSelector)

    const formRules = {
        required: function (value) {
            return  value.replace(/\s+/g, '') !== '' ? null : 'This field must not be empty'
        },

        email: function (value) {
            const emailRegex = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            return value.match(emailRegex) ? null : 'Invalid email'
        },

        min: function (min) {
            return function(value) {
                return value.length >= min ? null : `This field must be at least ${min} characters`
            }
        },

        max: function (max) {
            return function(value) {
                return value.length <= max ? null : `This field must not be more than ${max} characters`
            }
        },

        match: function (fieldToMatch) {
            return function(value) {
                return value === selectElement(`[name="${fieldToMatch}"]`).value  && value.replace(/\s+/g, '') !== ''
                    ? null : `Not match with ${fieldToMatch}`
            }
        }
    }

    if (form) {
        let isValid = true
        let inputValidatorRules = {}
        let formData = {}

        const inputs = form.querySelectorAll('[name][rules]')

        for (let input of inputs) {
            const inputRules = input.getAttribute('rules')

            // get rules from 'rules' attribute of input
            if (inputRules) {
                const rules = inputRules.split('|')
                
                for (const rule of rules) {
                    // get form rules function from the rules we get from the attribute
                    if (Array.isArray(inputValidatorRules[input.name])) {

                        // rule with parameter
                        if (rule.includes(':')) {
                            let ruleArray = rule.split(':')
                            let ruleName = ruleArray[0]
                            let parameter = ruleArray[1]

                            // console.log(ruleArray)

                            inputValidatorRules[input.name].push(formRules[ruleName](parameter))
                        } else {
                            inputValidatorRules[input.name].push(formRules[rule])
                        }
                    } else {
                        inputValidatorRules[input.name] = [formRules[rule]]
                    }
                }
            }

            // console.log(inputValidatorRules)

            // add event listener 'blur' and 'input' to each input
            const eventListeners = ['blur', 'input']
            
            var validate = (e) => {
                const ruleFunctions = inputValidatorRules[e.target.name]
                let parent = e.target.parentElement
                let errorMessage = e.target.closest('.container').querySelector('.error_message')

                // console.log(parent, errorMessage)

                for (const ruleFunction of ruleFunctions) {
                    var result = ruleFunction(e.target.value)
                    
                    if (result) {
                        // invalid
                        parent.classList.add('error')
                        errorMessage.innerText = result
                    } else {
                        // valid
                        parent.classList.remove('error')
                        errorMessage.innerText = ''
                    }
                }
                
                return !result
            }

            for (const eventListener of eventListeners) {
                input.addEventListener(eventListener, validate)
            }
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault()

            for (let input of inputs) {
                const formValidation = validate({target: input})

                formData[input.name] = input.value
                isValid = formValidation ? true : false
                if (isValid === false) break
            }

            if (isValid) {
                // VALID
                // console.log('valid')
                // console.log(formData)

                // construct body for each form
                const formElement = formSelector.split(' ')[0]
                let requestBody;

                // handle thumbnail and avatar
                let thumbnail = form.querySelector('[name="thumbnail"]')
                let thumbnailImage;
                if (thumbnail) {
                    thumbnailImage = thumbnail.value === '' ? '' : thumbnail.value.split(`\\`)[2]
                }

                let avatar = form.querySelector('[name="account_avatar"]')
                let avatarImage;
                if (avatar) {
                    avatarImage = avatar.value === '' ? 'default.jpg' : avatar.value.split(`\\`)[2]
                }

                switch(formElement) {
                    case '#create_post_form': {
                        requestBody = new URLSearchParams({
                            submit: 'submit',
                            csrf_token: form.querySelector('[name="csrf_token"]').value,
                            module: form.querySelector('[name="module"]').value,
                            title: formData['title'],
                            thumbnail: thumbnailImage,  
                            content: formData['content'],
                        })
                        break
                    }

                    case '#edit_post_form': {
                        requestBody = new URLSearchParams({
                            submit: 'submit',
                            csrf_token: form.querySelector('[name="csrf_token"]').value,
                            module: form.querySelector('[name="module"]').value,
                            title: formData['title'],
                            thumbnail: thumbnailImage,  
                            content: formData['content'],
                        })
                        break
                    }

                    case '#contact_email_form': {
                        requestBody = new URLSearchParams({
                            submit: 'submit',
                            email_title: formData['email_title'],
                            email_content: formData['email_content'],
                        })
                        break
                    }

                    case '#create_user_form': {
                        requestBody = new URLSearchParams({
                            submit: 'submit',
                            role: form.querySelector('[name="role"]').value,
                            account_name: formData['account_name'],
                            email: formData['email'],
                            password: formData['password'],
                        })
                        break
                    }

                    case '#edit_user_form': {
                        requestBody = new URLSearchParams({
                            submit: 'submit',
                            role: form.querySelector('[name="role"]').value,
                            account_avatar: avatarImage,
                            account_name: formData['account_name'],
                            email: formData['email'],
                            password: formData['password'],
                        })
                        break
                    }

                    case '#create_module_form': {
                        requestBody = new URLSearchParams({
                            submit: 'submit',
                            module_name: formData['module_name'],
                            teacher: formData['teacher'],
                            description: formData['description'],
                        })
                        break
                    }

                    case '#edit_module_form': {
                        requestBody = new URLSearchParams({
                            submit: 'submit',
                            module_name: formData['module_name'],
                            teacher: formData['teacher'],
                            description: formData['description'],
                        })
                        break
                    }
                }

                try {
                    const response = await fetch(form.action, {
                        method: form.method,
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: requestBody
                    })

                    // console.log(requestBody)
                    // console.log(await response.text())

                    const data = await response.json()

                    if (data && data.redirect) {
                        window.location.href = data.redirect
                    }

                } catch (error) {
                    console.error(error)
                }
                
            } else {
                // NOT VALID
                // console.log('valid')

                // give some warning if necessary
            }

        })

    }
}

function loginFormValidator() {
    // TODO
}

function registerFormValidator() {
    // TODO
}

function formValidatorEvent() {
    const form = selectElement('section > form')
    // console.log(form)

    if (form) {
        // limit characters inputs and textareas
        const textInputs = form.querySelectorAll('input[type="text"]')
        const textArea = form.querySelector('textarea')

        // console.log(textInput, textArea)

        // apply image preview feature for thumbnail and avatar
        const thumbnail = form.querySelector('.thumbnail_container')
        const avatar = form.querySelector('.avatar_container')

        const imagePreview = (e) => {
            const element = e.target

            let placeholderText = element.querySelector('div')
            let inputFile = element.querySelector('input[type="file"]')
            let imagePreview = element.querySelector('.image_preview')
            
            if (element.getAttribute('src')) {
                const parent = element.parentElement
                placeholderText = parent.querySelector('div')
                inputFile = parent.querySelector('input[type="file"]')
                imagePreview = parent.querySelector('.image_preview')
            }

            if (inputFile) {
                inputFile.click()
    
                inputFile.addEventListener('change', () => {
                    if (placeholderText) placeholderText.style.display = 'none'
                    imagePreview.style.display = 'block'    
                    imagePreview.src = URL.createObjectURL(inputFile.files[0])
                })
            }
        }

        const limitChar = (e) => {
            const element = e.target
            const max = parseInt(element.getAttribute('max'))
            const char_count = element.closest('.form_group').querySelector('.char_count')

            if (char_count) {
                let remainChar = max - element.value.length

                char_count.textContent = remainChar >= 0 ? remainChar : 0

                if (element.value.length >= max && parseInt(char_count.textContent) <= 0) {
                    element.value = element.value.slice(0, max)
                }
            }
        }

        if (textInputs.length !== 0) {
            textInputs.forEach(input => {
                input.addEventListener('input', limitChar)
            });
        }

        if (textArea) {
            textArea.addEventListener('input', limitChar)
        }

        if (thumbnail) {
            thumbnail.addEventListener('click', imagePreview)
        }

        if (avatar) {
            avatar.addEventListener('click', imagePreview)
        }
    }

}

function createPostFormValidator() {
    const titleInput = selectElement('[name="title"]')
    const contentInput = selectElement('[name="content"]')

    // set rules for form inputs
    if (titleInput) {
        titleInput.setAttribute('rules', 'required')
        contentInput.setAttribute('rules', 'required')
    }

    Validator('#create_post_form form')

}

function editPostFormValidator() {
    const titleInput = selectElement('[name="title"]')
    const contentInput = selectElement('[name="content"]')

    // set rules for form inputs
    if (titleInput) {
        titleInput.setAttribute('rules', 'required')
        contentInput.setAttribute('rules', 'required')
    }

    Validator('#edit_post_form form')
}

function messageFormValidator() {
    const titleInput = selectElement('[name="email_title"]')
    const contentInput = selectElement('[name="email_content"]')

    // set rules for form inputs
    if (titleInput) {
        titleInput.setAttribute('rules', 'required')
        contentInput.setAttribute('rules', 'required')
    }

    Validator('#contact_email_form form')
}


function createUserFormValidator() {
    const usernameInput = selectElement('[name="account_name"]')
    const emailInput = selectElement('[name="email"]')
    const passwordInput = selectElement('[name="password"]')
    const confirmPasswordInput = selectElement('[name="confirm_password"]')

    // set rules for form inputs
    if (usernameInput) {
        usernameInput.setAttribute('rules', 'required')
        emailInput.setAttribute('rules', 'required|email')
        passwordInput.setAttribute('rules', 'required|min:6')
        confirmPasswordInput.setAttribute('rules', 'required|min:6|match:password')
    }

    Validator('#create_user_form form')

}

function editUserFormValidator() {
    const usernameInput = selectElement('[name="account_name"]')
    const emailInput = selectElement('[name="email"]')
    const passwordInput = selectElement('[name="password"]')
    const confirmPasswordInput = selectElement('[name="confirm_password"]')

    // set rules for form inputs
    if (usernameInput) {
        usernameInput.setAttribute('rules', 'required')
        emailInput.setAttribute('rules', 'required|email')
        passwordInput.setAttribute('rules', 'required|min:6')
        confirmPasswordInput.setAttribute('rules', 'required|min:6|match:password')
    }

    Validator('#edit_user_form form')
}

function createModuleFormValidator() {
    const moduleNameInput = selectElement('[name="module_name"]')
    const teacherInput = selectElement('[name="teacher"]')
    const moduleDescriptionInput = selectElement('[name="description"]')

    if (moduleNameInput) {
        moduleNameInput.setAttribute('rules', 'required')
        teacherInput.setAttribute('rules', 'required')
        moduleDescriptionInput.setAttribute('rules', 'required')
    }

    Validator('#create_module_form form')
}

function editModuleFormValidator () {
    const moduleNameInput = selectElement('[name="module_name"]')
    const teacherInput = selectElement('[name="teacher"]')
    const moduleDescriptionInput = selectElement('[name="description"]')

    if (moduleNameInput) {
        moduleNameInput.setAttribute('rules', 'required')
        teacherInput.setAttribute('rules', 'required')
        moduleDescriptionInput.setAttribute('rules', 'required')
    }

    Validator('#edit_module_form form')
}

export {
    loginFormValidator,
    registerFormValidator,
    createPostFormValidator, 
    editPostFormValidator,
    messageFormValidator,
    createUserFormValidator,
    editUserFormValidator,
    formValidatorEvent,
    createModuleFormValidator,
    editModuleFormValidator
}