<template>
    <div v-bind="$attrs">
        <CKEditor
            v-model="content"
            :editor="editor"
            :config="editorConfig"
        />
    </div>
</template>

<script>
import CKEditor from '@ckeditor/ckeditor5-vue2';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

export default
{
    components: {
        'CKEditor': CKEditor.component
    },

    props: {
        value: {
            type: String,
            required: false,
            default: null
        }
    },

    data() {
      return {
          editor: ClassicEditor,
          editorConfig: {
              language: 'de',
              toolbar: [ 'bold', 'italic', 'link', '|', 'bulletedList', 'numberedList' ],
          }
      }
    },

    computed: {
        content: {
            get() {
                return this.value || '';
            },
            set(value) {
                console.log(value)
                this.$emit('input', value || null);
            }
        }
    }
}
</script>
