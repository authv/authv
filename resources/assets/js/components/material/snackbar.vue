<template>
    <div id="snackbar" class="mdl-js-snackbar mdl-snackbar">
        <div class="mdl-snackbar__text"></div>
        <button class="mdl-snackbar__action" type="button"></button>
    </div>
</template>

<script>
    export default {
        events: {
            showSnackbar: function(message, timeout, actionHandler, actionText) {
                this.show(message, timeout, actionHandler, actionText);
            }
        },
        methods: {
            show(message, timeout, actionHandler, actionText) {
                var data = {
                    message: message,
                    timeout: timeout,
                    actionHandler: actionHandler,
                    actionText: actionText
                };
                this.$el.MaterialSnackbar.showSnackbar(data);
            }
        },
        ready() {
            console.log('Snackbar component ready.')
        }
    }
</script>
