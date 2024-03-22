<!-- resources/js/Layouts/AppLayout.vue -->

<template>
    <div>
        <header>
            <!-- Your header content here -->
        </header>

        <main>
            <!-- Display the FileUploadForm component -->
            <FileUploadForm />
            <!-- Other main content here -->
            <slot />
        </main>

        <footer>
            <!-- Your footer content here -->
        </footer>
    </div>
</template>

<script>
import FileUploadForm from '@/Pages/FileUploadForm.vue';

export default {
    components: {
        FileUploadForm
    }
}
</script>
