<template>
    <v-container>
        <v-row>
            <v-col cols="12" lg="6">
                <div class="d-flex align-center">
                    <div class="text-h5 py-2 ml-4">Aktuelles</div>
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
                <news-table
                    class="mt-4"
                    :is-loading="isLoading"
                    :items="items"
                    @reload="getData"
                    @edit="edit"
                />
            </v-col>
            <v-col cols="12" lg="6">
                <news-create
                    v-if="view === 'create'"
                    @reload="getData"
                />
                <news-edit
                    v-if="view === 'edit'"
                    v-model="editItem"
                    @reload="getData"
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import NewsCreate from "./parts/NewsCreate";
import NewsEdit from "./parts/NewsEdit";
import NewsTable from "./parts/NewsTable";

export default {
    components: {
        NewsCreate,
        NewsEdit,
        NewsTable
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
            window.axios.get('/news')
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
