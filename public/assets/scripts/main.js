import { 
    handleSearchBarEvent, handlePostsEvents, handleSidemenuEvent, 
    handleFeedSettingEvent, handlePostViewEvents, handleWindowEvent, 
    handleDOMEvent,  handleModuleEvent, handleMessageEvent,
    handleAdminEvent, handleFormEvent
} from "./eventHandlers.js"

import {
    formValidatorEvent, loginFormValidator, registerFormValidator, 
    createPostFormValidator, editPostFormValidator, messageFormValidator, 
    createUserFormValidator, editUserFormValidator, createModuleFormValidator,
    editModuleFormValidator

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
            handleFormEvent()
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
            editUserFormValidator()
            createModuleFormValidator()
            editModuleFormValidator()
        }
    }
}

app.start()
