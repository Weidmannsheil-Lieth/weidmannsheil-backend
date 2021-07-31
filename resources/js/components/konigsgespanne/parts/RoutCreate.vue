<template>
    <div>
        <div class="text-h5 py-2 ml-4">
            Neu erstellen
        </div>
        <rout-form
            v-model="rout"
        />
        <div class="d-flex justify-end mt-6">
            <v-btn
                @click="create"
                color="primary"
                :disabled="!canSubmit"
                :loading="isLoading"
            >
                Erstellen
            </v-btn>
        </div>
    </div>
</template>

<script>
import RoutForm from './RoutForm';

export default {
    components: {
        RoutForm
    },
    data() {
        return {
            rout: {
                king: null
            },
            isLoading: false
        }
    },
    computed: {
        canSubmit() {
            return this.rout && this.rout.king
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.post('/routs', this.rout)
                .then((response) => {
                    this.$root.$notification.open(response.data.message)
                    this.clear();
                    this.$emit('reload')
                })
                .catch((error) => {
                    this.$root.$notification.open(error.response.data.message, 'error')
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        clear() {
            this.rout = {
                title: null,
                content: null
            }
        }
    }
}
</script>
