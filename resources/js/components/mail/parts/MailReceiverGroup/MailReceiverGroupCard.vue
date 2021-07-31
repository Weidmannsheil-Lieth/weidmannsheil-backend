<template>
    <v-card>
        <v-card-title>
            Empfängerlisten
            <v-spacer/>
            <mail-receiver-group-create @reload="getData"/>
        </v-card-title>
        <v-card-text class="mt-1">
            <mail-receiver-group-table
                :is-loading="isLoading"
                :items="mailReceiverGroups"
                @reload="getData"
            />
        </v-card-text>
    </v-card>
</template>

<script>
import {mapActions, mapGetters} from "vuex";
import MailReceiverGroupCreate from "./MailReceiverGroupCreate";
import MailReceiverGroupTable from "./MailReceiverGroupTable";

export default {
    components: {MailReceiverGroupTable, MailReceiverGroupCreate},
    data() {
        return {
            isLoading: false,
        }
    },
    created() {
        this.getData();
    },
    computed: {
        ...mapGetters('mailReceiverGroup', ['mailReceiverGroups'])
    },
    methods: {
        ...mapActions('mailReceiverGroup', ['getMailReceiverGroups']),
        getData() {
            this.isLoading = true;
            this.getMailReceiverGroups().finally(() => this.isLoading = false);
        }
    }
}
</script>
