<template>
    <div>
        <div class="text-h5 py-2 ml-4">
            Neu erstellen
        </div>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    v-model="album.year"
                    label="Jahr"
                    v-mask="'####'"
                />
                <v-text-field
                    v-model="album.name"
                    label="Name"
                />
            </v-col>
        </v-row>
        <div class="d-flex justify-end">
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
export default {
    data() {
        return {
            album: {
                year: null,
                name: null,
            },
            isLoading: false
        }
    },
    computed: {
        canSubmit() {
            return this.album
                && this.album.name
                && this.album.year
        }
    },
    methods: {
        create() {
            this.isLoading = true;

            window.axios.post('/gallery/albums', this.album)
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
            this.album = {
                year: null,
                name: null
            }
        }
    }
}
</script>
