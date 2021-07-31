<template>
    <div v-if="notice">
        <div class="text-h5 py-2 ml-4">
            Bearbeiten
        </div>
        <notice-form
            v-model="notice"
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
import NoticeForm from './NoticeForm';
import {cloneDeep} from "lodash";

export default {
    components: {
        NoticeForm
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
            notice: cloneDeep(this.value),
            isLoading: false
        }
    },
    computed: {
        hasChanges() {
            return this.notice && this.value
                && (
                    this.notice.priority.toString() !== this.value.priority.toString()
                    || this.notice.title !== this.value.title
                    || this.notice.content !== this.value.content
                );
        },
        canSubmit() {
            return this.notice
                && this.notice.priority
                && this.notice.title
                && this.notice.content
                && this.hasChanges
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.notice = cloneDeep(value);
            }
        }
    },
    methods: {
        create() {
            this.isLoading = true;
            window.axios.put('/notices/' + this.notice.id, this.notice)
                .then((response) => {
                    this.$root.$notification.open(response.data.message)
                    this.$emit('input', this.notice)
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
            this.notice = cloneDeep(this.value);
        }
    }
}
</script>
