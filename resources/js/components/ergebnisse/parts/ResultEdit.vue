<template>
    <div v-if="result">
        <div class="text-h5 py-2 ml-4">
            Bearbeiten
        </div>
        <v-text-field
            v-model="result.category"
            label="Kategorie"
        />
        <v-text-field
            v-model="result.name"
            label="Name"
        />
        <v-text-field
            v-if="result.contentType === 1"
            v-model="result.contentAction"
            label="Datei"
            disabled
        />
        <v-text-field
            v-if="result.contentType === 2"
            v-model="result.contentAction"
            label="URL"
            disabled
        />
        <div class="d-flex">
            <v-btn
                @click="reset"
                :disabled="!hasChanges"
                :loading="isLoading"
            >
                Zurücksetzen
            </v-btn>
            <v-spacer/>
            <v-btn
                @click="create"
                color="primary"
                :disabled="!canSubmit"
                :loading="isLoading"
            >
                Speichern
            </v-btn>
        </div>
    </div>
</template>

<script>
import {cloneDeep} from "lodash";

export default {
    props: {
        value: {
            type: Object,
            required: false,
            default: null
        }
    },
    data() {
        return {
            result: cloneDeep(this.value),
            isLoading: false
        }
    },
    computed: {
        hasChanges() {
            return this.result && this.value
                && (
                    this.result.name !== this.value.name
                    || this.result.category !== this.value.category
                );
        },
        canSubmit() {
            return this.result
                && this.result.name
                && this.hasChanges
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.result = cloneDeep(value);
            }
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.put('/results/' + this.result.id, this.result)
                .then((response) => {
                    this.$root.$notification.open(response.data.message)
                    this.$emit('input', this.result)
                    this.$emit('reload')
                })
                .catch((error) => {
                    this.$root.$notification.open(error.response.data.message, 'error')
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        reset() {
            this.result = cloneDeep(this.value);
        }
    }
}
</script>
