<template>
    <v-card>
        <v-card-title>
            Aktivitäten
        </v-card-title>
        <v-divider/>
        <v-card-text>
            <v-data-table
                :loading="isLoading"
                :headers="headers"
                :items="items"
                :footer-props="footerProps"
                :no-data-text="'Es wurden keine Aktivitäten gefunden.'"
                disable-sort
                dense
            >
                <template #item.createdAt="{item}">
                    {{ item.createdAt | dateTime }}
                </template>
                <template #item.activityId="{item}">
                    {{ activities[item.activityId] }}
                </template>
            </v-data-table>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
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
                    text: 'Benutzer',
                    value: 'user.name'
                },
                {
                    text: 'Objekt',
                    value: 'modelType'
                },
                {
                    text: 'Objekt ID',
                    value: 'modelId'
                },
                {
                    text: 'Aktivität',
                    value: 'activityId'
                }
            ],
            activities: {
                1: 'Erstellt',
                2: 'Bearbeitet',
                3: 'Gelöscht'
            }
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.isLoading = true;
            window.axios.get('/activity-log')
                .then((response) => this.items = response.data.data)
                .finally(() => this.isLoading = false)
        }
    }
}
</script>
