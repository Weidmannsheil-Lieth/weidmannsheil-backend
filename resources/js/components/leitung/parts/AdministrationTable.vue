<template>
    <v-data-table
        :loading="isLoading"
        :headers="headers"
        :items="items"
        :footer-props="footerProps"
        :no-data-text="'Es wurden keine Leitungen gefunden.'"
        disable-sort
        dense
    >
        <template v-slot:item.actions="{ item }">
            <v-btn
                color="primary"
                small
                @click="edit(item)"
                icon
            >
                <v-icon small>
                    fa-pen
                </v-icon>
            </v-btn>
            <delete-button
                :item="item"
                url="administrations"
                @reload="reload"
            />
        </template>
    </v-data-table>
</template>

<script>
import DeleteButton from "./../../global/DeleteButton";

export default {
    components: {DeleteButton},
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
            options: this.value,
            footerProps: {
                itemsPerPageOptions: [10, 20, 30]
            },
            headers: [
                {
                    text: 'Priorität',
                    value: 'priority'
                },
                {
                    text: 'Name',
                    value: 'name'
                },
                {
                    text: 'E-Mail',
                    value: 'email'
                },
                {
                    text: 'Aktionen',
                    value: 'actions'
                }
            ]
        };
    },
    watch: {
        options: {
            deep: true,
            handler() {
                this.$emit('input', this.options);
            }
        }
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
