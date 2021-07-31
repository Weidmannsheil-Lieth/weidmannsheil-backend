<template>
    <v-stepper-content
        step="2"
    >
        <v-file-input
            label="Anhänge"
            v-model="mail.attachments"
            counter
            chips
            multiple
            show-size
            truncate-length="20"
            class="mb-4"
        />

        <div class="text-subtitle-2 text-center mb-6">
            Die Anhänge sollten eine Gesamtgröße von 20MB <strong>nicht</strong> überschreiten.
        </div>

        <mail-send-action-buttons
            @forward="$emit('forward')"
            @backward="$emit('backward')"
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
                attachments: []
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
