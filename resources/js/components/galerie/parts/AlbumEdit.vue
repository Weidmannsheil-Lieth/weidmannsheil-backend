<template>
    <div v-if="album">
        <div class="text-h5 py-2 ml-4">
            Bearbeiten: {{ album.year }} - {{ album.name }}
        </div>
        <image-table
            class="mt-4"
            :items="images"
            @reload="getImages"
            :is-loading="isLoading"
        />
        <image-uploader
            :album="album"
            @reload="getImages"
        />
    </div>
</template>

<script>
import {cloneDeep} from "lodash";
import ImageTable from "./ImageTable";
import ImageUploader from "./ImageUploader";

export default {
    props: {
        value: {
            type: Object,
            required: false,
            default: null
        }
    },
    components: {
        ImageUploader,
        ImageTable
    },
    data() {
        return {
            album: cloneDeep(this.value),
            isLoading: false,
            images: []
        }
    },
    watch: {
        value: {
            deep: true,
            handler(value) {
                this.album = cloneDeep(value);
                this.getImages();
            }
        }
    },
    created() {
        this.getImages();
    },
    methods: {
        getImages() {
            this.isLoading = true;
            this.images = [];
            window.axios.get('/gallery/albums/' + this.album.id)
                .then((response) => {
                    this.images = response.data.data.galleryImages;
                })
                .finally(() => {
                    this.isLoading = false;
                });
        }
    }
}
</script>
