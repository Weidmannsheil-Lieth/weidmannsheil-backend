<template>
    <div>
        <div class="text-h5 py-2 ml-4">
            Neu erstellen
        </div>
        <notice-form
            v-model="notice"
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
import NoticeForm from './NoticeForm';

export default {
    components: {
        NoticeForm
    },
    data() {
        return {
            notice: {
                priority: null,
                title: null,
                content: null
            },
            isLoading: false
        }
    },
    computed: {
        canSubmit() {
            return this.notice
                && this.notice.priority
                && this.notice.title
                && this.notice.content
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.post('/notices', this.notice)
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
            this.notice = {
                priority: null,
                title: null,
                content: null
            }
        }
    }
}
</script>
