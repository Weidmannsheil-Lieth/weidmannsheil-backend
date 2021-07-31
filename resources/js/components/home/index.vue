<template>
    <v-container>
        <v-row>
            <v-col cols="12">
                <div class="text-h5 pt-2 ml-4">Dashboard</div>
            </v-col>
            <v-col cols="12" lg="6">
                <requests-today-card/>
            </v-col>
            <v-col cols="12" lg="6">
                <requests-month-card/>
            </v-col>
            <v-col cols="12" lg="6">
                <activity-log-card/>
            </v-col>
            <v-col cols="12" lg="6">
                <login-log-card/>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import RequestsTodayCard from "./parts/RequestsTodayCard";
import RequestsMonthCard from "./parts/RequestsMonthCard";
import ActivityLogCard from "./parts/ActivityLogCard";
import LoginLogCard from "./parts/LoginLogCard";

export default {
    components: {
        LoginLogCard,
        ActivityLogCard,
        RequestsTodayCard,
        RequestsMonthCard
    }
}
</script>
