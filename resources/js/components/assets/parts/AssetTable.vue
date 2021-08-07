<template>
    <v-data-table
        :loading="isLoading"
        :headers="headers"
        :items="items"
        :footer-props="footerProps"
        :items-per-page="20"
        :no-data-text="'Es wurden keine statischen Inhalte gefunden.'"
        :search="search"
        disable-sort
        dense
    >
        <template #item.updatedAt="{ item }">
            {{ item.updatedAt | dateTime }}
        </template>
        <template v-slot:item.actions="{ item }">
            <v-btn
                @click="showAsset(item.path)"
                color="primary"
                small
                icon
            >
                <v-icon small>
                    fa-eye
                </v-icon>
            </v-btn>
            <asset-edit-dialog
                :asset="item"
                @reload="reload"
            />
        </template>
    </v-data-table>
</template>

<script>
import AssetEditDialog from "./AssetEditDialog";

export default {
    components: {AssetEditDialog},
    props: {
        items: {
            type: Array,
            required: true,
            default: () => []
        },
        isLoading: {
            type: Boolean,
            required: true
        },
        search: {
            type: String,
            required: false,
            default: null
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
                    text: 'Name',
                    value: 'name'
                },
                {
                    text: 'MIME',
                    value: 'mime'
                },
                {
                    text: 'Pfad',
                    value: 'path'
                },
                {
                    text: 'Bearbeitet am',
                    value: 'updatedAt'
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
        showAsset(path) {
            window.open('/assets' + path, '_blank');
        }
    }
}
</script>
