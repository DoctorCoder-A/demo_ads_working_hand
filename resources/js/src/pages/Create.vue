<template>
    <h1>Create</h1>
    <div>
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input v-model="data.name" class="form-control" name="name" id="name" placeholder="Name">
        </div>
        <div class="mb-3">
            <label for="image_1" class="form-label">Image - 1</label>
            <input v-model="data.images[1]" class="form-control" id="image_1" name="images[]" placeholder="url image - 1">
        </div>
        <div class="mb-3">
            <label for="image_2" class="form-label">Image - 2</label>
            <input v-model="data.images[2]" class="form-control" id="image_2" name="images[]" placeholder="url image - 2">
        </div>
        <div class="mb-3">
            <label for="image_3" class="form-label">Image - 3</label>
            <input v-model="data.images[3]" class="form-control" id="image_3" name="images[]" placeholder="url image - 3">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea v-model="data.description" class="form-control" id="Description" rows="3"
                placeholder="Description"></textarea>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input v-model="data.price" class="form-control" name="price" id="price" placeholder="price">
        </div>
        <button @click.prevent="newAnnouncement" class="btn btn-primary">Send</button>
    </div>
</template>
<script setup>
import router from '@/router/router'
const data = {
    name: null,
    images: {
        1: null,
        2: null,
        3: null
    },
    description: null,
    price: null
}
const newAnnouncement = async () => {
    console.log({ data });
    let response = await axios.post('/api/announcements', data)
    router.push('/announcement/' + response.data.id)
}
</script>
