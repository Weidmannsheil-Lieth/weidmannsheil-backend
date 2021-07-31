<template>
    <div>
        <div class="text-h5 py-2 ml-4">
            Neu erstellen
        </div>
        <administration-form
            v-model="administration"
        />
        <div class="d-flex justify-end mt-2">
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
import AdministrationForm from './AdministrationForm';

export default {
    components: {
        AdministrationForm
    },
    data() {
        return {
            administration: {
                priority: null,
                name: null,
                members: null,
                email: null
            },
            isLoading: false
        }
    },
    computed: {
        canSubmit() {
            return this.administration
                && this.administration.priority
                && this.administration.name
                && this.administration.members
                && this.administration.email
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.post('/administrations', this.administration)
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
            this.administration = {
                priority: null,
                name: null,
                members: null,
                email: null
            }
        }
    }
}
</script>
