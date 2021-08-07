<template>
    <v-dialog
        v-model="dialog"
        max-width="500"
    >
        <template #activator="{ on, attrs }">
            <v-btn
                color="primary"
                small
                icon
                v-bind="attrs"
                v-on="on"
            >
                <v-icon small>
                    fa-upload
                </v-icon>
            </v-btn>
        </template>

        <v-card tile>
            <v-toolbar
                color="primary"
                dark
            >
                Datei hochladen
                <v-spacer/>
                <v-btn
                    icon
                    @click="dialog = false"
                >
                    <v-icon>fa-times</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text class="mt-5 mb-2">
                <v-file-input
                    v-model="file"
                    :accept="asset.mime"
                    label="Datei"
                    hide-details
                />
            </v-card-text>
            <v-card-actions>
                <v-spacer />
                <v-btn
                    @click="update"
                    color="primary"
                    :loading="isLoading"
                >
                    Hochladen
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        asset: {
            type: Object,
            required: false,
            default: () => ({
                id: null,
                mime: null
            })
        }
    },
    data() {
        return {
            dialog: false,
            isLoading: false,
            file: null
        }
    },
    methods: {
        update() {
            this.isLoading = true;

            let formData = new FormData();
            formData.append('file', this.file)

            window.axios.post('/assets/' + this.asset.id, formData, {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            })
                .then((response) => {
                    this.$root.$notification.open(response.data.message)
                    this.file = null;
                    this.dialog = false;
                    this.$emit('reload')
                })
                .catch((error) => {
                    this.$root.$notification.open(error.response.data.message, 'error')
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
    }
}
</script>
