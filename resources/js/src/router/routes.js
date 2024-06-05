import List from '@/pages/List.vue'
import Create from '@/pages/Create.vue'
import Show from '@/pages/Show.vue'
const routes = [
    {
        path: '/',
        component: List
    },
    {
        path: '/announcement/create',
        component: Create
    },
    {
        path: '/announcement/:id',
        component: Show,
        props: true
    },
];
export default routes
