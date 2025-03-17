const app = {
    animation: {
        components: {
            "collapse_icon": document.querySelector('.collapse_icon'),
        },

        init: function() {
            this.components['collapse_icon'].addEventListener('click', () => {
                document.querySelector('.side_menu').classList.toggle('collapsed')
            })
        }
    },

    start: function() {
        this.animation.init()
    }
}

app.start()
