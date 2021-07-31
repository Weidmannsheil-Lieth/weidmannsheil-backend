<template>
    <v-row no-gutters>
        <v-col cols="12">
            <div
                style="max-height: 200px; overflow-y: scroll"
                v-if="mail.receivers.length > 0"
                class="mb-4"
            >
                <v-simple-table dense>
                    <template v-slot:default>
                        <thead>
                        <tr>
                            <th class="text-left">
                                E-Mail
                            </th>
                            <th class="text-left">
                                Aktionen
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr
                            v-for="(item, index) in mail.receivers"
                            :key="index + item"
                        >
                            <td>{{ item }}</td>
                            <td>
                                <v-btn
                                    @click="removeMailFromReceivers(index)"
                                    color="error"
                                    small
                                    icon
                                >
                                    <v-icon small>fa-trash</v-icon>
                                </v-btn>
                            </td>
                        </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </div>
            <div class="d-flex mt-1">
                <v-text-field
                    v-model="email"
                    label="E-Mail hinzufügen"
                    class="mt-1 pt-0"
                />
                <v-btn
                    @click="addEmail"
                    :disabled="!canAddEmail"
                    icon
                    class="ml-1"
                >
                    <v-icon>fa-plus</v-icon>
                </v-btn>
            </div>
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
                mail: []
            })
        }
    },
    data() {
        return {
            mail: this.value,
            email: null
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.mail = value;
            }
        },
        mail: {
            deep: true,
            handler(value) {
                this.$emit('input', value)
            }
        }
    },
    computed: {
        canAddEmail() {
            return this.email && !this.mail.receivers.includes(this.email)
        }
    },
    methods: {
        removeMailFromReceivers(id) {
            this.mail.receivers.splice(id, 1)
        },
        addEmail() {
            this.mail.receivers.push(this.email);
            this.email = null;
        }
    }
}
</script>
