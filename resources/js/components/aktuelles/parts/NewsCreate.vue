<template>
    <div>
        <div class="text-h5 py-2 ml-4">
            Neu erstellen
        </div>
        <news-form
            v-model="news"
        />
        <div class="d-flex justify-end">
            <v-btn
                @click="create"
                color="primary"
                :disabled="!canSubmit"
                :loading="isLoading"
            >
                Erstellen
            </v-btn>
        </div>
    </div>
</template>

<script>
import NewsForm from './NewsForm';

export default {
    components: {
        NewsForm
    },
    data() {
        return {
            news: {
                priority: null,
                title: null,
                content: null
            },
            isLoading: false
        }
    },
    computed: {
        canSubmit() {
            return this.news
                && this.news.priority
                && this.news.title
                && this.news.content
                && this.news.imageUrl
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.post('/news', this.news)
                .then((response) => {
                    this.$root.$notification.open(response.data.message)
                    this.clear();
                    this.$emit('reload')
                })
                .catch((error) => {
                    this.$root.$notification.open(error.response.data.message, 'error')
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        clear() {
            this.news = {
                priority: null,
                title: null,
                content: null
            }
        }
    }
}
</script>
