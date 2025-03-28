import { 
    handlePostsEvents, handleSidemenuEvent, handlePostViewEvents, 
    handleDOMEvent
} from "./eventHandlers.js"

import {
    loginFormValidator, registerFormValidator, createPostFormValidator,
    messageFormValidator
} from './validators.js'

const app = {
    start: function() {
        document.addEventListener('DOMContentLoaded', () => {
            this.eventHandlers.init()
            this.validators.init()
        })
    },

    eventHandlers: {
        init: function() { 
            handleDOMEvent()
            handleSidemenuEvent()
            handlePostsEvents()
            handlePostViewEvents()

        }
    },

    validators: {
        init: function() {
            loginFormValidator()
            registerFormValidator()
            createPostFormValidator()
            messageFormValidator()
        }
    }
}

app.start()
