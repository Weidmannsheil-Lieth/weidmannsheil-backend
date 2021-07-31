<template>
    <v-dialog
        v-model="dialog"
        max-width="600"
        persistent
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                v-bind="attrs"
                v-on="on"
                icon
                small
            >
                <v-icon small>fa-pen</v-icon>
            </v-btn>
        </template>
        <v-card tile>
            <v-toolbar
                color="primary"
                dark
            >
                Gruppe bearbeiten
                <v-spacer/>
                <v-btn
                    icon
                    @click="closeDialog"
                >
                    <v-icon>fa-times</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text class="mt-4 pb-2">
                <v-text-field
                    label="Name"
                    v-model="mailReceiverGroup.name"
                />
                <mail-receiver-group-receivers v-model="mailReceiverGroup"/>
            </v-card-text>
            <v-card-actions>
                <v-btn
                    @click="reset"
                    :disabled="isLoading"
                >
                    Zurücksetzen
                </v-btn>
                <v-spacer/>
                <v-btn
                    @click="submit"
                    color="primary"
                    :loading="isLoading"
                    :disabled="!canSubmit"
                >
                    Speichern
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
import MailReceiverGroupReceivers from "./MailReceiverGroupReceivers";
import {cloneDeep} from "lodash";

export default {
    components: {MailReceiverGroupReceivers},
    props: {
        value: {
            type: Object,
            required: true,
            default: () => ({
                name: null,
                mailReceivers: []
            })
        }
    },
    data() {
        return {
            dialog: false,
            isLoading: false,
            mailReceiverGroup: cloneDeep(this.value)
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.mailReceiverGroup = cloneDeep(value);
            }
        }
    },
    computed: {
        hasChanges() {
            return this.mailReceiverGroup.name !== this.value.name
                || JSON.stringify(this.mailReceiverGroup.mailReceivers) !== JSON.stringify(this.value.mailReceivers)
        },
        canSubmit() {
            return this.mailReceiverGroup
                && this.mailReceiverGroup.name
                && this.mailReceiverGroup.mailReceivers
                && this.hasChanges
        }
    },
    methods: {
        reset() {
            this.mailReceiverGroup = cloneDeep(this.value);
        },
        closeDialog() {
            this.dialog = false;
            this.reset();
        },
        submit() {
            this.isLoading = true;
            window.axios.put('/mail-receiver-groups/' + this.mailReceiverGroup.id, {
                name: this.mailReceiverGroup.name,
                mailReceivers: JSON.stringify(this.mailReceiverGroup.mailReceivers)
            })
                .then((response) => {
                    this.closeDialog();
                    this.$emit('reload');
                    this.$emit('input', this.mailReceiverGroup);
                    this.$root.$notification.open(response.data.message)
                })
                .catch((error) => {
                    this.$root.$notification.open(error.response.data.message);
                })
                .finally(() => {
                    this.isLoading = false;
                })
        }
    }
}
</script>
