<template>
    <v-stepper-content
        step="4"
    >
        <v-row dense>
            <v-col cols="12" md="6">
                <v-text-field
                    label="Betreff"
                    v-model="mail.subject"
                    disabled
                />
                <v-textarea
                    label="Inhalt"
                    v-model="mail.content"
                    disabled
                />
            </v-col>
            <v-col cols="12" md="6">
                <div
                    v-if="isLoadingMailReceivers"
                    class="d-flex justify-center"
                >
                    <v-progress-circular
                        indeterminate
                    />
                </div>
                <div
                    v-else
                    style="width: 100%; height: 250px; max-height: 250px; overflow-y: scroll"
                >
                    <v-simple-table dense>
                        <template v-slot:default>
                            <thead>
                            <tr>
                                <th class="text-left">
                                    Empfänger
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr
                                v-for="(item, index) in mailReceivers"
                                :key="index + item"
                            >
                                <td>{{ item }}</td>
                            </tr>
                            </tbody>
                        </template>
                    </v-simple-table>
                </div>
            </v-col>
        </v-row>

        <mail-send-action-buttons
            @forward="$emit('forward')"
            @backward="$emit('backward')"
            forward-label="Senden"
        />
    </v-stepper-content>
</template>

<script>
import MailSendActionButtons from "../MailSendActionButtons";

export default {
    components: {
        MailSendActionButtons
    },
    props: {
        value: {
            type: Object,
            required: true,
            default: () => ({
                subject: null,
                content: null
            })
        },
        step: {
            type: Number,
            required: true,
            default: null
        }
    },
    data() {
        return {
            mail: this.value,
            isLoadingMailReceivers: false,
            mailReceivers: []
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.mail = value;
            }
        },
        step(value) {
            if (value === 4) {
                this.loadMailReceivers()
            }
        }
    },
    methods: {
        loadMailReceivers() {
            this.isLoadingMailReceivers = true;
            let params = {
                receivers: this.mail.receivers,
                receiverGroups: this.mail.receiverGroups
            };
            window.axios.get('mail/receiver-preview', {params})
                .then((response) => {
                    this.mailReceivers = response.data.receivers;
                })
                .finally(() => this.isLoadingMailReceivers = false)
        }
    }
}
</script>
