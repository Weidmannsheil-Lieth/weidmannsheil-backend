<template>
    <v-row>
        <v-col cols="12">
            <v-row no-gutters>
                <v-col cols="10">
                    <v-text-field
                        v-model="notice.title"
                        label="Titel"
                    />
                </v-col>
                <v-col cols="2">
                    <v-text-field
                        v-model="notice.priority"
                        label="Priorität"
                        v-mask="'###'"
                        class="pl-2"
                    />
                </v-col>
            </v-row>
            <v-textarea
                v-model="notice.content"
                label="Inhalt"
                rows="8"
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
            default: () => {

            }
        }
    },
    data() {
        return {
            notice: this.value
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.notice = value;
            }
        },
        notice: {
            deep: true,
            handler(value) {
                this.$emit('input', value);
            }
        }
    }
}
</script>
