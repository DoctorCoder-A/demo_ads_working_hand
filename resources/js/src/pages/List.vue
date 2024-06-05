<template>
    <h1>List</h1>

    <div class="card" style="width: 18rem;" v-for="item in announcements" :key="item.id" v-if="announcements.length > 0">
        <img :src="item.image" class="card-img-top" alt="{{item.image}}">
        <div class="card-body">
            <h5 class="card-title">Name: {{item.name}}</h5>
            <p class="card-text">Price: {{item.price}}</p>
            <a @click.prevent="onShow(item.id)" class="btn btn-primary">Go somewhere</a>
        </div>
    </div>
    <div class="card" style="width: 18rem;" v-else>
        Empty
    </div>
</template>
<script setup>
import { onMounted, ref } from 'vue';
import router from '../router/router'

let announcements = ref([])
onMounted(async ()=>{
    getAnnouncement()
})

const getAnnouncement = async () => {
    let response = await axios.get("/api/announcements")
    announcements.value = response.data.data
}
const onShow = (id)=>{
    router.push('/announcement/' + id)
}
</script>
