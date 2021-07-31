<template>
    <v-row no-gutters>
        <v-col cols="12" class="d-flex">
            <v-spacer/>
            <v-btn
                class="mr-2 elevation-0"
                :disabled="disableBackward"
                @click="$emit('backward')"
            >
                {{ backwardLabel }}
            </v-btn>
            <v-btn
                class="elevation-0"
                color="primary"
                :disabled="disableForward"
                @click="$emit('forward')"
            >
                {{ forwardLabel }}
            </v-btn>
        </v-col>
    </v-row>
</template>

<script>
export default {
    props: {
        forwardLabel: {
            type: String,
            required: false,
            default: 'Weiter'
        },
        backwardLabel: {
            type: String,
            required: false,
            default: 'Zurück'
        },
        disableForward: {
            type: Boolean,
            required: false,
            default: false
        },
        disableBackward: {
            type: Boolean,
            required: false,
            default: false
        }
    }
}
</script>
