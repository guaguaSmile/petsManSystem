import Login from '../components/login/Index.vue';
import PetsIndex from '../components/pets/Index.vue';
import PetsDetail from '../components/pets/Detail.vue';
import PetsEdit from '../components/pets/Edit.vue';

export const routes = [
    {
        path: '/',
        component: Login
    },
    {
        name: 'pets',
        path: '/pets',
        component: PetsIndex
    },
    {
        path: '/pets/:id/detail',
        component: PetsDetail,
        props: true
    },
    {
        path: '/pets/:id/edit',
        component: PetsEdit,
        props: true
    }
];
