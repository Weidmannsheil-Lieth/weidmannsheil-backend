<template>
    <div>
        <navigation-bar @toggle="toggle"/>
        <navigation-drawer
            v-model="showMenu"
            v-if="isAuth"
            @toggle="toggle"
        />
    </div>
</template>

<script>
import NavigationDrawer from "./NavigationDrawer";
import NavigationBar from "./NavigationBar";
import {mapGetters} from "vuex";

export default {
    components: {NavigationDrawer, NavigationBar},
    data() {
        return {
            showMenu: true
        }
    },
    computed: {
      ...mapGetters('auth', ['isAuth'])
    },
    methods: {
        toggle() {
            this.showMenu = !this.showMenu;
        }
    }
}
</script>
