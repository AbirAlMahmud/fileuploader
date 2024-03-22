<template>
    <div>
        <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <input type="file" name="file" ref="fileInput">
            <button type="submit">Upload</button>
        </form>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
    methods: {
        submitForm() {
            const file = this.$refs.fileInput.files[0];
            const formData = new FormData();
            formData.append('file', file);

            // Send the form data to the server
            // You can use Axios or fetch for AJAX requests
            fetch('/upload', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('File uploaded successfully. Unique ID:', data.unique_id);
                // Handle response as needed
            })
            .catch(error => {
                console.error('An error occurred while uploading the file:', error);
                // Handle error as needed
            });
        }
    }
}
</script>
