<template>
    <v-container>
        <v-row>
            <v-col cols="12" lg="9">
                <div class="text-h5 py-2 ml-4">Statische Inhalte</div>
            </v-col>
            <v-col cols="12" lg="3">
                <v-text-field
                    v-model="search"
                    label="Suche"
                    hide-details
                />
            </v-col>
        </v-row>

        <asset-table
            class="mt-4"
            :is-loading="isLoading"
            :items="items"
            :search="search"
            @reload="getData"
        />
    </v-container>
</template>

<script>
import AssetTable from "./parts/AssetTable";

export default {
    components: {
        AssetTable
    },
    data() {
        return {
            isLoading: false,
            items: [],
            search: null
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.view = 'create';
            this.isLoading = true;
            window.axios.get('/assets')
                .then((response) => {
                    this.items = response.data.data;
                })
                .finally(() => {
                    this.isLoading = false;
                })
        },
    }
}
</script>
