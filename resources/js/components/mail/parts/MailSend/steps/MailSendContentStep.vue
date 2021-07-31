<template>
    <v-stepper-content
        step="1"
    >
        <v-text-field
            v-model="mail.subject"
            label="Betreff"
        />
        <v-textarea
            v-model="mail.content"
            label="Inhalt"
        />
        <mail-send-action-buttons
            @forward="$emit('forward')"
            @backward="$emit('backward')"
            :disable-backward="true"
            :disable-forward="!canContinue"
        />
    </v-stepper-content>
</template>

<script>
import MailSendActionButtons from "../MailSendActionButtons";

export default {
    props: {
        value: {
            type: Object,
            required: true,
            default: () => ({
                subject: null,
                content: null
            })
        }
    },
    components: {
        MailSendActionButtons
    },
    data() {
        return {
            mail: this.value
        }
    },
    computed: {
        canContinue() {
            return this.mail
                && this.mail.subject
                && this.mail.content
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
