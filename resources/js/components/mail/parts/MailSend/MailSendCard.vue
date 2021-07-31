<template>
    <v-card>
        <v-card-title>
            Mail versenden
        </v-card-title>
        <v-stepper
            v-if="!isLoading"
            v-model="stepper"
            vertical
            class="elevation-0"
        >
            <v-stepper-step
                :complete="stepper > 1"
                step="1"
                class="pt-2"
            >
                Nachricht verfassen
            </v-stepper-step>
            <mail-send-content-step
                v-model="mail"
                @forward="stepper++"
            />

            <v-stepper-step
                :complete="stepper > 2"
                step="2"
            >
                Anhänge hinzufügen
            </v-stepper-step>
            <mail-send-attachments-step
                v-model="mail"
                @forward="stepper++"
                @backward="stepper--"
            />

            <v-stepper-step
                :complete="stepper > 3"
                step="3"
            >
                Empfänger wählen
            </v-stepper-step>
            <mail-send-receiver-step
                v-model="mail"
                @forward="stepper++"
                @backward="stepper--"
            />

            <v-stepper-step
                :complete="stepper > 4"
                step="4"
            >
                Bestätigen
            </v-stepper-step>
            <mail-send-approval-step
                v-model="mail"
                :step="stepper"
                @forward="sendMail"
                @backward="stepper--"
            />
        </v-stepper>
        <v-skeleton-loader
            v-else
            class="mx-auto"
            type="card"
        />
    </v-card>
</template>

<script>
import MailSendContentStep from "./steps/MailSendContentStep";
import MailSendReceiverStep from "./steps/MailSendReceiverStep";
import MailSendApprovalStep from "./steps/MailSendApprovalStep";
import MailSendAttachmentsStep from "./steps/MailSendAttachmentsStep";

export default {
    components: {MailSendAttachmentsStep, MailSendApprovalStep, MailSendReceiverStep, MailSendContentStep},
    data() {
        return {
            stepper: 1,
            mail: {
                subject: null,
                content: null,
                receivers: [],
                receiverGroups: []
            },
            isLoading: false
        }
    },
    methods: {
        sendMail() {
            this.isLoading = true;

            let formData = new FormData();
            formData.append('subject', this.mail.subject);
            formData.append('content', this.mail.content);
            formData.append('receivers', JSON.stringify(this.mail.receivers));
            formData.append('receiverGroups', JSON.stringify(this.mail.receiverGroups));
            if (this.mail.attachments) {
                this.mail.attachments.forEach((item) => {
                    formData.append('attachments[]', item);
                })
            }

            window.axios.post('mail', formData, {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            })
                .then((response) => {
                    this.$root.$notification.open(response.data.message);
                    this.reset();
                })
                .catch((error) => {
                    this.$root.$notification.open(error.response.data.message);
                }).finally(() => this.isLoading = false)
        },
        reset() {
            this.stepper = 1;
            this.mail = {
                subject: null,
                content: null,
                receivers: [],
                receiverGroups: []
            }
        }
    }
}
</script>
