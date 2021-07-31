<template>
    <v-app-bar color="primary" dark app clipped-left>
        <v-app-bar-nav-icon v-if="isAuth" @click="toggle" />
        <v-toolbar-title @click="switchPage('home')" class="cursor-pointer">Weidmannsheil</v-toolbar-title>
    </v-app-bar>
</template>

<script>
import {mapGetters} from "vuex";

export default {
    data() {
        return {
            showMenu: false
        };
    },
    computed: {
      ...mapGetters('auth', ['isAuth'])
    },
    methods: {
        toggle() {
            this.$emit('toggle');
        },
        switchPage(name) {
            if (this.$route.name !== name) {
                this.$router.push({name: name});
            }
        }
    }
};
</script>

<style>
.cursor-pointer {
    cursor: pointer;
}
</style>
