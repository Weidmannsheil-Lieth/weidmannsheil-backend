<template>
    <div class="notifications-container">
        <v-alert
            v-for="(notification, index) in notifications"
            :key="index"
            colored-border
            border="right"
            :type="notification.type"
            elevation="4"
        >
            {{ notification.message }}
        </v-alert>
    </div>
</template>

<script>
export default {
    data() {
        return {
            notifications: [],
            notificationVisibleTime: 6000
        }
    },
    methods: {
        open(message, type = 'info') {
            console.log(type)
            this.notifications.push({
                message: message,
                type: type
            });
            setTimeout(() => {
                this.notifications.shift();
            }, this.notificationVisibleTime)
        }
    }
}
</script>

<style lang="scss">
.notifications-container {
    position: fixed;
    width: 98%;
    max-width: 400px;
    right: 1%;
    bottom: 1%;
}
</style>
