<template>
    <h1>Show</h1>
    <div class="container">
        <h2>FieldList:</h2>
        <div class="form-check form-switch">
            <label class="form-check-label" for="id-checkbox">
                <input v-model="fields.id" @change="getAnnouncement" class="form-check-input" type="checkbox" value=""
                    id="id-checkbox">
                Add id
            </label>
        </div>
        <div class="form-check form-switch">
            <label class="form-check-label" for="images-checkbox">
                <input v-model="fields.images" @change="getAnnouncement" class="form-check-input" type="checkbox" value=""
                    id="images-checkbox">
                Add images
            </label>
        </div>
        <div class="form-check form-switch">
            <label class="form-check-label" for="description-checkbox">
                <input v-model="fields.description" @change="getAnnouncement" class="form-check-input" type="checkbox"
                    value="" id="description-checkbox">
                Add description
            </label>
        </div>
        <div class="form-check form-switch">
            <label class="form-check-label" for="created_at-checkbox">
                <input v-model="fields.created_at" @change="getAnnouncement" class="form-check-input" type="checkbox"
                    value="" id="created_at-checkbox">
                Add created_at
            </label>
        </div>
    </div>
    <div class="container">
        <ul class="list-group">
            <li class="list-group-item" v-if="announcement.id">ID:{{ announcement.id }}</li>
            <li class="list-group-item">Name: {{ announcement.name }}</li>
            <div class="text-center">
                <h4>main-Image:</h4>
                <img :src="announcement.image" class="rounded">
            </div>
            <h4 v-if="announcement.images">Images:</h4>
            <div class="text-center" v-for="item in announcement.images" v-if="announcement.images">
                <img :src="item.image" class="rounded" width="500px">
            </div>
            <li class="list-group-item" v-if="announcement.description">Description: {{ announcement.description }}</li>
            <li class="list-group-item">Price: {{ announcement.price }}</li>
            <li class="list-group-item" v-if="announcement.created_at">Created_at: {{ announcement.created_at }}</li>
        </ul>
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
let fields = {
    id: false,
    description: false,
    images: false,
    created_at: false,
}
const setFields = () => {
    form.fields = []
    for (const [key, value] of Object.entries(fields)) {
        console.log({ key, value });
        if (value === false) {
            continue
        }
        console.log({ key: value });
        form.fields.push(key)
    }
}
let form = {
    orderBy: 'price',
    orderType: 'desc',
    fields: []
}
let announcement = ref({ id: '' })
const props = defineProps({
    id: {
        type: String,
        default: ''
    }
})
onMounted(async () => {
    getAnnouncement()
})
// console.log(props);
const getAnnouncement = async () => {
    setFields()
    const response = await axios.post('/api/announcements/' + props.id, form)
    announcement.value = response.data.data
}
</script>
