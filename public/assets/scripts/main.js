import { 
    handleSearchBarEvent, handlePostsEvents, handleSidemenuEvent, 
    handlePostViewEvents, handleWindowEvent, handleDOMEvent, 
    handleModuleEvent, handleAdminEvent, handleCreateUserFormEvent
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
            handleWindowEvent()
            handleDOMEvent()
            handleSidemenuEvent()
            handlePostsEvents()
            handlePostViewEvents()
            handleSearchBarEvent()
            handleModuleEvent()
            handleAdminEvent()
            handleCreateUserFormEvent()
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
