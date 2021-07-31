<template>
    <v-row>
        <v-col cols="12">
            <v-row no-gutters>
                <v-col cols="10">
                    <v-text-field
                        v-model="administration.name"
                        label="Name"
                    />
                </v-col>
                <v-col cols="2">
                    <v-text-field
                        v-model="administration.priority"
                        label="Priorität"
                        v-mask="'###'"
                        class="pl-2"
                    />
                </v-col>
            </v-row>
            <v-textarea
                v-model="administration.members"
                label="Inhalt"
                rows="4"
            />
            <v-text-field
                v-model="administration.email"
                label="E-Mail"
            />
        </v-col>
    </v-row>
</template>

<script>
export default {
    props: {
        value: {
            type: Object,
            required: true,
            default: () => ({
                title: null,
                imageUrl: null,
                content: null,
            })
        }
    },
    data() {
        return {
            administration: this.value
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.administration = value;
            }
        },
        administration: {
            deep: true,
            handler(value) {
                this.$emit('input', value);
            }
        }
    }
}
</script>
