<template>
    <v-dialog
        v-model="dialog"
        fullscreen
        hide-overlay
        transition="dialog-bottom-transition"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                v-bind="attrs"
                v-on="on"
                block
            >
                Bild auswählen
            </v-btn>
        </template>
        <v-card tile>
            <v-toolbar
                dark
                color="primary"
            >
                <v-toolbar-title>Bild auswählen</v-toolbar-title>
                <v-spacer />
                <v-btn
                    icon
                    @click="dialog = false"
                    class="mx-2"
                >
                    <v-icon>fa-times</v-icon>
                </v-btn>
            </v-toolbar>
            <v-card-text class="py-6">
                <v-row class="d-flex justify-center mx-auto pt-4 pb-8" style="max-width: 1200px">
                    <v-col cols="12" lg="8">
                        <v-text-field
                            v-model="customUrl"
                            label="Eigene URL verwenden"
                            hide-details
                            class="pa-0"
                        />
                    </v-col>
                    <v-col cols="12" lg="4">
                        <v-btn
                            color="primary"
                            @click="setUrlToCustomUrl"
                            block
                        >
                            Übernehmen
                        </v-btn>
                    </v-col>
                </v-row>
                <v-row class="d-flex justify-center mx-auto" style="max-width: 1200px">
                    <v-col
                        cols="4"
                        md="3"
                        sm="6"
                        v-for="index in 30"
                        :key="index"
                    >
                        <div class="news-image-container">
                            <img
                                @click="selectImage(index)"
                                :src="getImageUrl(index)"
                                alt=""
                            />
                            <div v-if="getImageUrl(index) === url" class="news-image-selected-item">
                                <v-icon large>fa-check</v-icon>
                            </div>
                        </div>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    props: {
        value: {
            type: String,
            required: false,
            default: null
        }
    },
    data() {
        return {
            dialog: false,
            customUrl: null,
            url: this.value
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.url = value;
            }
        },
        url: {
            deep: true,
            handler(value) {
                this.$emit('input', value)
            }
        }
    },
    methods: {
        selectImage(index) {
            this.url = this.getImageUrl(index)
            this.dialog = false;
        },
        getImageUrl(index) {
            return process.env.MIX_APP_URL + '/assets/aktuelles/' + index + '.jpg';
        },
        setUrlToCustomUrl() {
            this.url = this.customUrl;
            this.dialog = false;
        }
    }
}
</script>

<style lang="scss">
.news-image-container {
    width: 100%;
    position: relative;
    user-select: none;

    img {
        width: 100%;
    }

    .news-image-selected-item {
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        background: #fff9;
        display: flex;
        justify-content: center;
        align-items: center;
    }
}
</style>
