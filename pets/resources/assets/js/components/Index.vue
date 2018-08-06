<template>
    <div class="main">
        <headCom></headCom>
        <siderBar></siderBar>
        <div class="content">
            <router-view></router-view>
        </div>
        <!--<footerCom></footerCom>-->
    </div>
</template>

<script>
    import headCom from './common/HeadCom.vue';
    import footerCom from './common/FooterCom.vue';
    import siderBar from './common/SiderBar.vue';
    import login from './login/Index.vue';
    export default {
        name: 'index',
        data: function () {
            return {
                is_login: login.is_login
            }
        },
        components: {
            headCom,
            footerCom,
            siderBar,
            login
        }
    }
</script>

<style>
    html, body{ margin:0; height:100%; }
    .main {
        margin:0; height:100%;
    }
</style>