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

            <HtmlEditor
                v-model="notice.content"
                class="mb-4"
            />
        </v-col>
    </v-row>
</template>

<script>
import HtmlEditor from "../../global/HtmlEditor.vue";

export default {
    components: {
        HtmlEditor
    },

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
