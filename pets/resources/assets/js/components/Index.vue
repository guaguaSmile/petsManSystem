<template>
    <div class="main">
        <headCom v-if="is_login"></headCom>
        <siderBar v-if="is_login"></siderBar>
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
    export default {
        name: 'index',
        data: function () {
            return {
                is_login: false,
            }
        },
        created() {
            var isLogin = localStorage.getItem('logged');
            if (isLogin) {
                this.is_login = true;
            }
        },
        components: {
            headCom,
            footerCom,
            siderBar,
        }
    }
</script>

<style>
    html, body{ margin:0; height:100%; }
    .main {
        margin:0; height:100%;
    }
</style>