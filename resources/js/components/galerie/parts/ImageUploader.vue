<template>
    <v-row>
        <v-col cols="12" class="text-h5 py-2 ml-4">
            Bilder hochladen
        </v-col>
        <v-col cols="12" class="text-center my-2">
            {{
                this.files.length === 0
                    ? 'Es werden keine Bilder hochgeladen.'
                    : 'Fortschritt: ' + this.files.length + ' Bild(er) verbleibend.'
            }}
        </v-col>
        <v-form class="image-uploader-form">
            <v-col cols="12">
                <input
                    id="image-uploader-input"
                    type="file"
                    multiple
                    accept="image/*"
                    @change="addImagesToUpload"
                />
                <label
                    for="image-uploader-input"
                    @drop.prevent="addDropImagesToUpload"
                    @dragover.prevent
                >
                    <v-icon
                        class="mr-2"
                    >
                        fa-images
                    </v-icon>
                    {{
                        this.files.length === 0
                            ? 'Bilder zum Hinzufügen hier ablegen'
                            : 'Weitere Bilder hier ablegen'
                    }}
                </label>
            </v-col>
        </v-form>
    </v-row>
</template>

<script>
export default {
    props: {
        album: {
            type: Object,
            required: true,
            default: () => ({
                year: null,
                name: null
            })
        }
    },
    data() {
        return {
            files: []
        }
    },
    methods: {
        reload() {
            this.$emit('reload');
        },
        uploadImage() {
            this.isUploading = true;

            let formData = new FormData();
            formData.append('albumId', this.album.id);
            formData.append('image', this.files[0]);

            window.axios.post('gallery/images', formData, {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            })
                .catch((error) => {
                    console.log(error)
                })
                .finally(() => {
                    this.files.shift();
                    this.reload();
                    if (this.files.length > 0) {
                        this.uploadImage();
                    } else {
                        this.isUploading = false;
                    }
                });
        },
        addFileListToUpload(fileList) {
            for (let i = 0; i < fileList.length; i++) {
                this.files.push(fileList[i]);
            }
            if (!this.isUploading) {
                this.uploadImage()
            }
        },
        addImagesToUpload(event) {
            this.addFileListToUpload(event.target.files);
        },
        addDropImagesToUpload(event) {
            this.addFileListToUpload(event.dataTransfer.files);
        }
    }
}
</script>

<style lang="scss">
.image-uploader-form {
    width: 100%;

    input[type=file] {
        display: none;
    }

    label {
        width: 80%;
        min-height: 100px;
        margin: 0 auto;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px dotted #7c9473;
        border-radius: 15px;
    }
}
</style>
