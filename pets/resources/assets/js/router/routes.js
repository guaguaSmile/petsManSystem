import Login from '../components/login/Index.vue';
import PetsIndex from '../components/pets/Index.vue';
import PetsDetail from '../components/pets/Detail.vue';
import PetsEdit from '../components/pets/Edit.vue';
import Category from '../components/category/Index.vue';
import User from '../components/user/Index.vue';

export const routes = [
    {
        name: 'login',
        path: '/',
        component: Login
    },
    {
        name: 'user',
        path: '/user',
        component: User
    },
    {
        name: 'pets',
        path: '/pets',
        component: PetsIndex
    },
    {
        name: 'petsDetail',
        path: '/pets/:id/detail',
        component: PetsDetail,
        props: true
    },
    {
        path: '/category',
        component: Category,
        props: true
    },
    {
        path: '/pets/:id/edit',
        component: PetsEdit,
        props: true
    },
    {
        path: '/pets/:id/edit',
        component: PetsEdit,
        props: true
    }
];
