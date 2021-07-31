<template>
    <v-card>
        <v-card-title>
            API Anfragen diesen Monat
        </v-card-title>
        <v-divider/>
        <v-card-text>
            <line-chart :data="data" height="450px"/>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    data() {
        return {
            isLoading: false,
            data: null
        }
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            this.isLoading = true;
            window.axios.get('/dashboard/requests-month')
                .then((response) => this.data = response.data)
                .finally(() => this.isLoading = false)
        }
    }
}
</script>
