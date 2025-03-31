import { 
    handleSearchBarEvent, handlePostsEvents, handleSidemenuEvent, 
    handlePostViewEvents, handleDOMEvent, handleModuleEvent,
    handleAdminEvent
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
            handleSearchBarEvent()
            handleModuleEvent()
            handleAdminEvent()
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
