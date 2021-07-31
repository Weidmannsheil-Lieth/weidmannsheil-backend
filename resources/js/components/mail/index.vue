<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <div class="d-flex align-center">
                    <div class="text-h5 pt-2 ml-4">Webmail</div>
                </div>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12" lg="6">
                <mail-send-card/>
            </v-col>
            <v-col cols="12" lg="6">
                <mail-receiver-group-card/>
            </v-col>
        </v-row>
    </v-container>
</template>


<script>
import MailSendCard from "./parts/MailSend/MailSendCard";
import MailReceiverGroupCard from "./parts/MailReceiverGroup/MailReceiverGroupCard";

export default {
    components: {MailReceiverGroupCard, MailSendCard}
}
</script>
