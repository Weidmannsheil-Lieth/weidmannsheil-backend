<template>
    <v-data-table
        :loading="isLoading"
        :headers="headers"
        :items="items"
        :footer-props="footerProps"
        :no-data-text="'Es wurden keine Bilder gefunden.'"
        disable-sort
        dense
    >
        <template v-slot:item.actions="{ item }">
            <v-dialog max-width="1000">
                <template v-slot:activator="{ on, attrs }">
                    <v-btn
                        color="primary"
                        small
                        icon
                        v-bind="attrs"
                        v-on="on"
                    >
                        <v-icon small>
                            fa-eye
                        </v-icon>
                    </v-btn>
                </template>
                <v-card>
                    <v-img style="background: #000" :src="getImageSrc(item.path)"/>
                </v-card>
            </v-dialog>
            <delete-button
                :item="item"
                url="gallery/images"
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
                    text: 'Pfad',
                    value: 'path'
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
        getImageSrc(path) {
            return '/galerie/' + path;
        }
    }
}
</script>
