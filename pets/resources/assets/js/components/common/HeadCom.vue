<template>
    <div class="header">
        <nav class="nav navbar navbar-expand navbar-dark bg-info" role="navigation" style="margin-bottom: 0px">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">宠物管理系统</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">通知</a></li>
                        <li><a href="#">{{ user.username }}</a></li>
                        <li><a href="javascript:;" @click="_logout">退出登录</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'HeadCom',
        data() {
            return {
                user: {
                    username: '',
                }
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        created() {
            this._getUserInfo()
        },
        methods: {
            _getUserInfo() {
                fetch('/api/user/auth').then(res => res.json())
                    .then(res => {
                        this.user = res.data;
                    })
            },
            _logout() {
//                var self = this;
                axios.post('/api/logout')
                    .then(function(res) {
                        var code = res.code;
                        var msg = res.msg;
                        if (code !== 0) {
                            return alert(msg);
                        }
                    })
                localStorage.removeItem('logged');
                this.$router.push({name: 'login'})
            }
        }
    }
</script>

<style>

</style>
