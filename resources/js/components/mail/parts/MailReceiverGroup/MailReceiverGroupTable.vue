<template>
    <v-data-table
        :loading="isLoading"
        :headers="headers"
        :items="items"
        :footer-props="footerProps"
        :no-data-text="'Es wurden keine Gruppen gefunden.'"
        disable-sort
        dense
    >
        <template v-slot:item.actions="{ item }">
            <div class="d-flex">
                <mail-receiver-group-edit
                    v-model="item"
                    @reload="reload"
                />
                <delete-button
                    :item="item"
                    url="mail-receiver-groups"
                    @reload="reload"
                />
            </div>
        </template>
    </v-data-table>
</template>

<script>
import DeleteButton from "../../../global/DeleteButton";
import MailReceiverGroupEdit from "./MailReceiverGroupEdit";

export default {
    components: {MailReceiverGroupEdit, DeleteButton},
    props: {
        items: {
            type: Array,
            required: true,
            default: () => []
        },
        isLoading: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            footerProps: {
                itemsPerPageOptions: [10, 20, 30]
            },
            headers: [
                {
                    text: 'Gruppe',
                    value: 'name'
                },
                {
                    text: 'Anzahl',
                    value: 'mailReceiversCount'
                },
                {
                    text: 'Aktionen',
                    value: 'actions'
                }
            ]
        };
    },
    methods: {
        reload() {
            this.$emit('reload');
        },
        edit(item) {
            this.$emit('edit', item);
        }
    }
}
</script>
