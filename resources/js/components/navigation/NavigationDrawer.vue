<template>
    <v-navigation-drawer
        v-model="showMenu"
        clipped
        app
        class="elevation-5"
    >
        <v-list-item class="my-2">
            <v-list-item-avatar>
                <v-avatar
                    color="secondary"
                    size="56"
                >
                    <span style="color: #fff">
                        {{ user.abbreviation }}
                    </span>
                </v-avatar>
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title>
                    {{ user.name }}
                </v-list-item-title>
                <v-list-item-subtitle
                    class="text-caption cursor-pointer"
                    @click="logout"
                >
                    Abmelden
                </v-list-item-subtitle>
            </v-list-item-content>
        </v-list-item>

        <v-divider/>

        <v-list dense>
            <v-list-item-group>
                <v-list-item
                    v-for="(item, index) in items"
                    :key="index"
                    @click="openPage(item.page)"
                >
                    <v-list-item-icon class="d-flex justify-center">
                        <v-icon small>{{ item.icon }}</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>{{ item.name }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list-item-group>
        </v-list>
    </v-navigation-drawer>
</template>

<script>
import {mapActions, mapGetters} from "vuex";

export default {
    props: {
        value: {
            type: Boolean,
            required: true
        }
    },
    data() {
        return {
            showMenu: this.value,
            items: [
                {
                    icon: 'fa-chart-line',
                    name: 'Dashboard',
                    page: 'home'
                },
                {
                    icon: 'fa-asterisk',
                    name: 'Wichtige Hinweise',
                    page: 'hinweise'
                },
                {
                    icon: 'fa-bookmark',
                    name: 'Aktuelles',
                    page: 'aktuelles'
                },
                {
                    icon: 'fa-crown',
                    name: 'Königsgespanne',
                    page: 'königsgespanne'
                },
                {
                    icon: 'fa-book-reader',
                    name: 'Leitung',
                    page: 'leitung'
                },
                {
                    icon: 'fa-poll',
                    name: 'Ergebnisse',
                    page: 'ergebnisse'
                },
                {
                    icon: 'fa-image',
                    name: 'Galerie',
                    page: 'galerie'
                },
                {
                    icon: 'fa-envelope',
                    name: 'Webmail',
                    page: 'mail'
                }
            ],
        }
    },
    computed: {
        ...mapGetters('auth', ['user'])
    },
    watch: {
        showMenu(value) {
            this.$emit('input', value)
        },
        value(value) {
            this.showMenu = value;
        }
    },
    methods: {
        ...mapActions('auth', ['logout']),
        openPage(name) {
            this.$router.push({name: name});
        }
    }
}
</script>

<style>
.cursor-pointer {
    cursor: pointer;
}
</style>
