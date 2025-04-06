import { 
    handleSearchBarEvent, handlePostsEvents, handleSidemenuEvent, 
    handleFeedSettingEvent, handlePostViewEvents, handleWindowEvent, 
    handleDOMEvent,  handleModuleEvent, handleMessageEvent,
    handleAdminEvent, handleCreateUserFormEvent
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
            handleFeedSettingEvent()
            handlePostsEvents()
            handlePostViewEvents()
            handleSearchBarEvent()
            handleModuleEvent()
            handleMessageEvent()
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
