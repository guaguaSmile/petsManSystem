import VueRouter from 'vue-router';
import Vue from 'vue';

const pets_detail = () => import('@/components/pets/Detail.vue')

Vue.use(VueRouter)

export default function creatRoutes() {
    const router = new VueRouter({
        routes: [
            {
                path: 'api/pets/1/detail',
                name: 'pets_detail',
                meta:{},
                component: pets_detail
            },
        ]
    })

    return router
}