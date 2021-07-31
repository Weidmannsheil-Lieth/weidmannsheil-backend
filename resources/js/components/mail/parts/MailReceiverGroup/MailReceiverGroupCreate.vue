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
            >
                Erstellen
            </v-btn>
        </template>
        <v-card tile>
            <v-toolbar
                color="primary"
                dark
            >
                Gruppe erstellen
                <v-spacer/>
                <v-btn
                    icon
                    @click="dialog = false"
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

export default {
    components: {MailReceiverGroupReceivers},
    data() {
        return {
            dialog: false,
            isLoading: false,
            mailReceiverGroup: {
                name: null,
                mailReceivers: []
            }
        }
    },
    computed: {
        canSubmit() {
            return this.mailReceiverGroup
                && this.mailReceiverGroup.name
                && this.mailReceiverGroup.mailReceivers
        }
    },
    methods: {
        reset() {
            this.mailReceiverGroup.name = null;
            this.mailReceiverGroup.mailReceivers = [];
        },
        submit() {
            this.isLoading = true;
            window.axios.post('/mail-receiver-groups', {
                name: this.mailReceiverGroup.name,
                mailReceivers: JSON.stringify(this.mailReceiverGroup.mailReceivers)
            })
                .then((response) => {
                    this.dialog = false;
                    this.$emit('reload');
                    this.reset();
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
