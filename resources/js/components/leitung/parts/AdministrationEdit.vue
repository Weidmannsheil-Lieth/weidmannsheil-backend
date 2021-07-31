<template>
    <div v-if="administration">
        <div class="text-h5 py-2 ml-4">
            Bearbeiten
        </div>
        <administration-form
            v-model="administration"
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
import AdministrationForm from './AdministrationForm';
import {cloneDeep} from "lodash";

export default {
    components: {
        AdministrationForm
    },
    props: {
        value: {
            type: Object,
            required: false,
            default: null
        }
    },
    data() {
        return {
            administration: cloneDeep(this.value),
            isLoading: false
        }
    },
    computed: {
        hasChanges() {
            return this.administration && this.value
                && (
                    this.administration.name !== this.value.name
                    || this.administration.priority !== this.value.priority
                    || this.administration.members !== this.value.members
                    || this.administration.email !== this.value.email
                );
        },
        canSubmit() {
            return this.administration
                && this.administration.name
                && this.administration.priority
                && this.administration.members
                && this.administration.email
                && this.hasChanges
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.administration = cloneDeep(value);
            }
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.put('/administrations/' + this.administration.id, this.administration)
                .then((response) => {
                    this.$root.$notification.open(response.data.message)
                    this.$emit('input', this.administration)
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
            this.administration = cloneDeep(this.value);
        }
    }
}
</script>
