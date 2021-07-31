<template>
    <v-row>
        <v-col cols="12">
            <v-row dense class="pt-3">
                <v-col md="6" cols="12">
                    <v-row no-gutters>
                        <v-col cols="8">
                            <v-text-field
                                v-model="news.title"
                                label="Titel"
                                class="pt-0"
                            />
                        </v-col>
                        <v-col cols="4">
                            <v-text-field
                                v-model="news.priority"
                                label="Priorität"
                                v-mask="'###'"
                                class="pl-2 pt-0"
                            />
                        </v-col>
                    </v-row>
                </v-col>
                <v-col md="6" cols="12">
                    <v-img
                        v-if="news.imageUrl"
                        :src="news.imageUrl"
                        class="mb-2"
                    />
                    <news-image-picker
                        v-model="news.imageUrl"
                    />
                </v-col>
            </v-row>
            <v-textarea
                v-model="news.content"
                label="Inhalt"
                rows="8"
            />
        </v-col>
    </v-row>
</template>

<script>
import NewsImagePicker from './NewsImagePicker';

export default {
    components: {
        NewsImagePicker
    },
    props: {
        value: {
            type: Object,
            required: true,
            default: () => ({
                priority: null,
                title: null,
                imageUrl: null,
                content: null,
            })
        }
    },
    data() {
        return {
            news: this.value
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.news = value;
            }
        },
        news: {
            deep: true,
            handler(value) {
                this.$emit('input', value);
            }
        }
    }
}
</script>
