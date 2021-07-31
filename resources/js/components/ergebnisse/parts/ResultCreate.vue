<template>
    <div>
        <div class="text-h5 py-2 ml-4">
            Neu erstellen
        </div>
        <v-row>
            <v-col cols="12">
                <v-text-field
                    v-model="result.category"
                    label="Kategorie"
                />
                <v-text-field
                    v-model="result.name"
                    label="Name"
                />
                <v-switch
                    v-model="targetIsFile"
                    :label="targetLabel"
                />
                <v-text-field
                    v-model="result.redirect"
                    v-if="!targetIsFile"
                    label="URL"
                />
                <v-file-input
                    v-if="targetIsFile"
                    v-model="result.downloadFile"
                    label="Datei"
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
            result: {
                category: null,
                name: null,
                redirect: null,
                downloadFile: null
            },
            isLoading: false,
            targetIsFile: false
        }
    },
    computed: {
        canSubmit() {
            return this.result
                && this.result.name
                && ((!this.targetIsFile && this.result.redirect) || (this.targetIsFile && this.result.downloadFile))
        },
        targetLabel() {
            return this.targetIsFile
                ? 'Datei hochladen'
                : 'Weiterleitung';
        }
    },
    methods: {
        create() {
            this.isLoading = true;

            let formData = new FormData();
            formData.append('category', this.result.category)
            formData.append('name', this.result.name);
            if (this.targetIsFile) {
                formData.append('downloadFile', this.result.downloadFile)
            } else {
                formData.append('redirect', this.result.redirect);
            }

            window.axios.post('/results/' + (this.targetIsFile ? 'download' : 'redirect'), formData, {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            })
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
            this.result = {
                category: null,
                name: null,
                redirect: null,
                downloadFile: null
            }
        }
    }
}
</script>
