<template>
    <div v-if="rout">
        <div class="text-h5 py-2 ml-4">
            Bearbeiten
        </div>
        <rout-form
            v-model="rout"
            :edit="true"
        />
        <div class="d-flex mt-6">
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
import RoutForm from './RoutForm';
import {cloneDeep} from "lodash";

export default {
    components: {
        RoutForm
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
            rout: cloneDeep(this.value),
            isLoading: false
        }
    },
    computed: {
        hasChanges() {
            return this.rout && this.value
                && (
                    this.rout.king !== this.value.king
                    || this.rout.youthKing !== this.value.youthKing
                    || this.rout.firstKnight !== this.value.firstKnight
                    || this.rout.secondKnight !== this.value.secondKnight
                    || this.rout.citizenKing !== this.value.citizenKing
                    || this.rout.citizenYouthKing !== this.value.citizenYouthKing
                );
        },
        canSubmit() {
            return this.rout && this.rout.king && this.hasChanges
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.rout = cloneDeep(value);
            }
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.put('/routs/' + this.rout.id, this.rout)
                .then((response) => {
                    this.$root.$notification.open(response.data.message)
                    this.$emit('input', this.rout)
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
            this.rout = cloneDeep(this.value);
        }
    }
}
</script>
