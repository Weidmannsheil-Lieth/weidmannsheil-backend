<template>
    <v-row>
        <v-col cols="12">
            <v-row>
                <v-col cols="6">
                    <v-text-field
                        v-model="rout.year"
                        label="Jahr"
                        :disabled="edit"
                        v-mask="'####'"
                        hide-details
                    />
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        v-model="rout.king"
                        label="König*in"
                        hide-details
                    />
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        v-model="rout.firstKnight"
                        label="Erster Ritter"
                        hide-details
                    />
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        v-model="rout.secondKnight"
                        label="Zweiter Ritter"
                        hide-details
                    />
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        v-model="rout.youthKing"
                        label="Jugendkönig*in"
                        hide-details
                    />
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        v-model="rout.citizenKing"
                        label="Bürgerkönig*in"
                        hide-details
                    />
                </v-col>
                <v-col cols="6">
                    <v-text-field
                        v-model="rout.citizenYouthKing"
                        label="Jugendbürgerkönig*in"
                        hide-details
                    />
                </v-col>
            </v-row>
        </v-col>
    </v-row>
</template>

<script>
export default {
    props: {
        value: {
            type: Object,
            required: true,
            default: () => {
            }
        },
        edit: {
            type: Boolean,
            required: false,
            default: false
        }
    },
    data() {
        return {
            rout: this.value
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.rout = value;
            }
        },
        rout: {
            deep: true,
            handler(value) {
                this.$emit('input', value);
            }
        }
    }
}
</script>
