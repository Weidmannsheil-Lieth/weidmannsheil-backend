<template>
    <v-card>
        <v-card-title>
            Anmeldungen
        </v-card-title>
        <v-divider/>
        <v-card-text>
            <v-data-table
                :loading="isLoading"
                :headers="headers"
                :items="items"
                :footer-props="footerProps"
                :no-data-text="'Es wurden keine Anmeldungen gefunden.'"
                disable-sort
                dense
            >
                <template #item.createdAt="{item}">
                    {{ item.createdAt | dateTime }}
                </template>
                <template #item.actions="{item}">
                    <login-log-details-dialog :login-log="item" />
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
import LoginLogDetailsDialog from "./LoginLogDetailsDialog";
export default {
    components: {LoginLogDetailsDialog},
    data() {
        return {
            isLoading: false,
            items: [],
            footerProps: {
                itemsPerPageOptions: [10, 20, 30]
            },
            headers: [
                {
                    text: 'Datum',
                    value: 'createdAt'
                },
                {
                    text: 'Username',
                    value: 'username'
                },
                {
                    text: 'IP-Adresse',
                    value: 'ipAddress'
                },
                {
                    text: 'Aktionen',
                    value: 'actions'
                }
            ]
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.isLoading = true;
            window.axios.get('/login-log')
                .then((response) => this.items = response.data.data)
                .finally(() => this.isLoading = false)
        }
    }
}
</script>
