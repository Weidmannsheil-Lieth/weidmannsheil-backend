<template>
    <div v-if="news">
        <div class="text-h5 py-2 ml-4">
            Bearbeiten
        </div>
        <news-form
            v-model="news"
        />
        <div class="d-flex">
            <v-btn
                @click="reset"
                :disabled="!hasChanges"
                :loading="isLoading"
            >
                Zurücksetzen
            </v-btn>
            <v-spacer/>
            <v-btn
                @click="create"
                color="primary"
                :disabled="!canSubmit"
                :loading="isLoading"
            >
                Speichern
            </v-btn>
        </div>
    </div>
</template>

<script>
import NewsForm from './NewsForm';
import {cloneDeep} from "lodash";

export default {
    components: {
        NewsForm
    },
    props: {
        value: {
            type: Object,
            required: false,
            default: null
        }
    },
    data() {
        return {
            news: cloneDeep(this.value),
            isLoading: false
        }
    },
    computed: {
        hasChanges() {
            return this.news && this.value
                && (
                    this.news.priority.toString() !== this.value.priority.toString()
                    || this.news.title !== this.value.title
                    || this.news.content !== this.value.content
                    || this.news.imageUrl !== this.value.imageUrl
                );
        },
        canSubmit() {
            return this.news
                && this.news.priority
                && this.news.title
                && this.news.content
                && this.news.imageUrl
                && this.hasChanges
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.news = cloneDeep(value);
            }
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.put('/news/' + this.news.id, this.news)
                .then((response) => {
                    this.$root.$notification.open(response.data.message)
                    this.$emit('input', this.news)
                    this.$emit('reload')
                })
                .catch((error) => {
                    this.$root.$notification.open(error.response.data.message, 'error')
                })
                .finally(() => {
                    this.isLoading = false;
                });
        },
        reset() {
            this.news = cloneDeep(this.value);
        }
    }
}
</script>
