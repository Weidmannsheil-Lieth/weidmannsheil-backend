<template>
    <v-dialog max-width="1000">
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                small
                icon
                v-bind="attrs"
                v-on="on"
            >
                <v-icon small>
                    fa-eye
                </v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-card-title>
                {{ loginLog.createdAt | dateTime }} - {{ loginLog.ipAddress }}
            </v-card-title>
            <v-divider/>
            <v-card-text class="mt-2">
                <v-row>
                    <v-col cols="12" lg="6">
                        <v-row dense>
                            <v-col cols="6" class="font-weight-bold">
                                Datum
                            </v-col>
                            <v-col cols="6">
                                {{ loginLog.createdAt | dateTime }}
                            </v-col>
                            <v-col cols="6" class="font-weight-bold">
                                Aktion
                            </v-col>
                            <v-col cols="6">
                                {{ actionIds[loginLog.actionId] }}
                            </v-col>
                            <v-col cols="6" class="font-weight-bold">
                                Username
                            </v-col>
                            <v-col cols="6">
                                {{ loginLog.username }}
                            </v-col>
                        </v-row>
                    </v-col>
                    <v-col cols="12" lg="6">
                        <v-row dense>
                            <v-col cols="6" class="font-weight-bold">
                                IP-Adresse
                            </v-col>
                            <v-col cols="6">
                                {{ loginLog.ipAddress }}
                            </v-col>
                            <v-col cols="6" class="font-weight-bold">
                                Stadt
                            </v-col>
                            <v-col cols="6">
                                {{ getIpAddressDetailsValue('city') }}
                            </v-col>
                            <v-col cols="6" class="font-weight-bold">
                                Region
                            </v-col>
                            <v-col cols="6">
                                {{ getIpAddressDetailsValue('region') }}
                            </v-col>
                            <v-col cols="6" class="font-weight-bold">
                                Land
                            </v-col>
                            <v-col cols="6" class="d-flex justify-start align-center">
                                <div
                                    v-if="getIpAddressDetailsField('country')"
                                    style="width: 16px;"
                                    class="mr-1"
                                >
                                    <v-img :src="getCountryImageSrc(getIpAddressDetailsField('country'))" />
                                </div>
                                {{ getIpAddressDetailsValue('country') }}
                            </v-col>
                            <v-col cols="6" class="font-weight-bold">
                                Standort
                            </v-col>
                            <v-col cols="6">
                                {{ getIpAddressDetailsValue('loc') }}
                            </v-col>
                            <v-col cols="6" class="font-weight-bold">
                                Zeitzone
                            </v-col>
                            <v-col cols="6">
                                {{ getIpAddressDetailsValue('timezone') }}
                            </v-col>
                        </v-row>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        loginLog: {
            type: Object,
            required: true,
            default: () => null
        }
    },
    data() {
        return {
            actionIds: {
                1: 'Erfolgreicher Login',
                2: 'Fehlgeschlagener Login',
                3: 'Logout'
            }
        }
    },
    methods: {
        getIpAddressDetailsField(field) {
            if (this.loginLog.ipAddressDetails && this.loginLog.ipAddressDetails[field]) {
                return this.loginLog.ipAddressDetails[field];
            }
            return null;
        },
        getIpAddressDetailsValue(field) {
            return this.getIpAddressDetailsField(field) ?? '-';
        },
        getCountryImageSrc(country) {
            if (country) {
                return 'https://www.countryflags.io/' + country + '/shiny/16.png'
            }
            return null;
        }
    }
}
</script>
