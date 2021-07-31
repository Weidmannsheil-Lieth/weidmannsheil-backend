<template>
    <v-btn
        icon
        color="error"
        @click="deleteItem"
        small
        :loading="isLoading"
    >
        <v-icon small>fa-trash</v-icon>
    </v-btn>
</template>

<script>
export default {
    props: {
        item: {
            type: Object,
            required: true,
            default: () => ({
                id: null
            })
        },
        url: {
            type: String,
            required: true,
            default: null
        }
    },
    data() {
        return {
            isLoading: false
        }
    },
    methods: {
        deleteItem() {
            this.isLoading = true;
            window.axios.delete(this.url + '/' + this.item.id)
                .then((response) => {
                    this.$emit('reload');
                    this.$root.$notification.open(response.data.message)
                })
                .finally(() => {
                    this.isLoading = false;
                })
        }
    }
}
</script>
