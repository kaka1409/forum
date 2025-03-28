import { 
    handlePostsEvents, handleSidemenuEvent, handlePostViewEvents, 
    handleDOMEvent
} from "./eventHandlers.js"

import {
    loginFormValidator, registerFormValidator, createPostFormValidator,
    messageFormValidator
} from './validators.js'

const app = {
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
            createPostFormValidator()
        }
    },

    start: function() {
        this.eventHandlers.init()
        this.validators.init()
    }
}

document.addEventListener('DOMContentLoaded', () => {
    app.start()
})
