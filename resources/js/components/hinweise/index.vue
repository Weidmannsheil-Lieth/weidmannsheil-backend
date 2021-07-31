<template>
    <v-container>
        <v-row>
            <v-col cols="12" lg="6">
                <div class="d-flex align-center">
                    <div class="text-h5 py-2 ml-4">Wichtige Hinweise</div>
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
                <notice-table
                    class="mt-4"
                    :is-loading="isLoading"
                    :items="items"
                    @reload="getData"
                    @edit="edit"
                />
            </v-col>
            <v-col cols="12" lg="6">
                <notice-create
                    v-if="view === 'create'"
                    @reload="getData"
                />
                <notice-edit
                    v-if="view === 'edit'"
                    v-model="editItem"
                    @reload="getData"
                />
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import NoticeCreate from "./parts/NoticeCreate";
import NoticeEdit from "./parts/NoticeEdit";
import NoticeTable from "./parts/NoticeTable";

export default {
    components: {
        NoticeCreate,
        NoticeEdit,
        NoticeTable
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
            window.axios.get('/notices')
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
