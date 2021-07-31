<template>
    <v-container>
        <v-row>
            <v-col cols="12" lg="6">
                <div class="d-flex align-center">
                    <div class="text-h5 py-2 ml-4">Alben</div>
                    <v-btn
                        color="primary"
                        class="ml-2"
                        @click="create"
                        icon
                    >
                        <v-icon>
                            fa-plus
                        </v-icon>
                    </v-btn>
                </div>
                <album-table
                    class="mt-4"
                    :is-loading="isLoading"
                    :items="items"
                    @reload="getData"
                    @edit="edit"
                />
            </v-col>
            <v-col cols="12" lg="6">
                <album-create
                    v-if="view === 'create'"
                    @reload="getData"
                />
                <album-edit
                    v-if="view === 'edit'"
                    v-model="editItem"
                    @reload="getData"
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import AlbumCreate from "./parts/AlbumCreate";
import AlbumEdit from "./parts/AlbumEdit";
import AlbumTable from "./parts/AlbumTable";

export default {
    components: {
        AlbumCreate,
        AlbumEdit,
        AlbumTable
    },
    data() {
        return {
            isLoading: false,
            view: 'create',
            editItem: null,
            items: []
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.view = 'create';
            this.isLoading = true;
            window.axios.get('/gallery/albums')
                .then((response) => {
                    this.items = response.data.data;
                })
                .finally(() => {
                    this.isLoading = false;
                })
        },
        reload() {
            this.getData();
        },
        create() {
            this.view = 'create';
        },
        edit(item) {
            this.editItem = item;
            this.view = 'edit';
        }
    }
}
</script>
