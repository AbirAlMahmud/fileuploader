<template>
    <div>
      <dropzone id="file-upload" @drop="uploadFile" :options="dropzoneOptions">
        <div class="dz-message">Drop files here or click to upload.</div>
      </dropzone>
      <div v-if="uploadProgress !== null">
        <progress :value="uploadProgress" max="100"></progress>
      </div>
    </div>
  </template>

  <script>
  import { Dropzone } from '@inertiajs/inertia-vue'

  export default {
    components: {
      Dropzone,
    },
    data() {
      return {
        uploadProgress: null,
        dropzoneOptions: {
          url: this.$route('file.upload'),
          maxFilesize: 10240, // 10GB maximum
          maxFiles: 1,
          paramName: 'file',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          },
          init: function () {
            this.on('uploadprogress', function (file, progress) {
              this.$emit('upload-progress', progress);
            });
          },
        },
      };
    },
    methods: {
      uploadFile(file) {
        this.$inertia.post(this.$route('file.upload'), {
          file: file,
        });
      },
    },
    created() {
      this.$root.$on('upload-progress', (progress) => {
        this.uploadProgress = progress;
      });
    },
  };
  </script>
