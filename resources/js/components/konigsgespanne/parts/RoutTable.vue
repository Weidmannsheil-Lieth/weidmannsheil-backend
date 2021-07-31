<template>
    <v-data-table
        :loading="isLoading"
        :headers="headers"
        :items="items"
        :footer-props="footerProps"
        :no-data-text="'Es wurden keine Gespanne gefunden.'"
        disable-sort
        dense
    >
        <template v-slot:item.content="{ item }">
            {{ getPreview(item.content) }}
        </template>
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
                url="routs"
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
                    text: 'Jahr',
                    value: 'year'
                },
                {
                    text: 'König*in',
                    value: 'king'
                },
                {
                    text: 'Jugendkönig*in',
                    value: 'youthKing'
                },
                {
                    text: 'Bürgerkönig*in',
                    value: 'citizenKing'
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
        getPreview(content) {
            if (content.length <= 50) {
                return content;
            }
            let cut = content.slice(0, 50);
            let index = cut.lastIndexOf(' ');
            if (index !== -1) {
                cut = cut.slice(0, index);
            }
            return cut + '...';
        },
        edit(item) {
            this.$emit('edit', item);
        }
    }
}
</script>
