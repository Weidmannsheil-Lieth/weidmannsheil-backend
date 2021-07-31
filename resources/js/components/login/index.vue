<template>
    <v-container class="fill-height d-flex align-center justify-center">
        <v-card max-width="450px" width="100%">
            <v-form @submit.prevent="performLogin">
                <v-card-text>
                    <v-text-field
                        v-model="username"
                        label="Benutzer"
                        hide-details
                        class="pb-4"
                    />
                    <v-text-field
                        v-model="password"
                        type="password"
                        label="Passwort"
                        hide-details
                        class="pb-8"
                    />
                </v-card-text>
                <v-divider/>
                <v-card-actions>
                    <div class="text-body-2" v-if="hasError">
                        <v-icon
                            small
                            color="error"
                            class="mx-1"
                        >
                            fa-exclamation
                        </v-icon>
                        Login fehlgeschlagen
                    </div>
                    <v-spacer/>
                    <v-btn
                        type="submit"
                        color="primary"
                        :loading="isLoading"
                    >
                        Anmelden
                    </v-btn>
                </v-card-actions>
            </v-form>
        </v-card>
    </v-container>
</template>

<script>
import {mapActions} from "vuex";

export default {
    data() {
        return {
            username: null,
            password: null,
            isLoading: false,
            hasError: false
        }
    },
    methods: {
        ...mapActions('auth', ['login']),
        performLogin() {
            if (!this.username || !this.password) {
                return;
            }

            this.isLoading = true;
            this.hasError = false;

            this.login({
                username: this.username,
                password: this.password
            }).then(() => {
                this.$router.push({name: 'home'})
            }).catch(() => {
                this.hasError = true;
            }).finally(() => {
                this.isLoading = false;
            })
        }
    }
}
</script>
