import { 
    handleSearchBarEvent, handlePostsEvents, handleSidemenuEvent, 
    handleFeedSettingEvent, handlePostViewEvents, handleWindowEvent, 
    handleDOMEvent,  handleModuleEvent, handleMessageEvent,
    handleAdminEvent
} from "./eventHandlers.js"

import {
    formValidatorEvent, loginFormValidator, registerFormValidator, 
    createPostFormValidator, editPostFormValidator, messageFormValidator, 
    createUserFormValidator
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
        }
    },

    validators: {
        init: function() {
            formValidatorEvent()
            loginFormValidator()
            registerFormValidator()
            createPostFormValidator()
            editPostFormValidator()
            messageFormValidator()
            createUserFormValidator()
        }
    }
}

app.start()
