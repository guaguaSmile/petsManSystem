<template>
    <div class="main">
        <headCom v-if="is_login"></headCom>
        <siderBar></siderBar>
        <div class="content">
            <router-view></router-view>
        </div>
        <footerCom v-if="is_login"></footerCom>
    </div>
</template>

<script>
    import headCom from './common/HeadCom.vue';
    import footerCom from './common/FooterCom.vue';
    import siderBar from './common/SiderBar.vue';
    export default {
        name: 'index',
        data: function () {
            return {
                is_login: ''
            }
        },
        components: {
            headCom,
            footerCom,
            siderBar
        }
    }
</script>