<template>
    <v-stepper-content
        step="3"
    >
        <v-autocomplete
            label="Empfängergruppen"
            v-model="mail.receiverGroups"
            :items="mailReceiverGroups"
            item-text="name"
            item-value="id"
            chips
            clearable
            deletable-chips
            multiple
            class="mb-2"
        />
        <mail-send-custom-mails-form
            v-model="mail"
        />
        <mail-send-action-buttons
            :disable-forward="!canContinue"
            @forward="$emit('forward')"
            @backward="$emit('backward')"
        />
    </v-stepper-content>
</template>

<script>
import MailSendActionButtons from "../MailSendActionButtons";
import {mapGetters} from "vuex";
import MailSendCustomMailsForm from "../parts/MailSendCustomMailsForm";

export default {
    components: {
        MailSendCustomMailsForm,
        MailSendActionButtons
    },
    props: {
        value: {
            type: Object,
            required: true,
            default: () => ({
                subject: null,
                content: null,
                receivers: [],
                receiverGroups: []
            })
        }
    },
    data() {
        return {
            mail: this.value
        }
    },
    computed: {
        ...mapGetters('mailReceiverGroup', ['mailReceiverGroups']),
        canContinue() {
            return this.mail.receivers.length + this.mail.receiverGroups.length > 0
        }
    },
    watch: {
        mail: {
            deep: true,
            handler(value) {
                this.$emit('input', value)
            }
        },
        value: {
            deep: true,
            handler(value) {
                this.mail = value;
            }
        }
    }
}
</script>
