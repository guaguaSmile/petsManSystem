<template>
    <div class="container" style="margin-top: 30%; width: 300px">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="username" class="col-sm-3">用户名</label>
                <div class="col-sm-9">
                    <input v-model="form.username" id="username" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="password" class="col-sm-3">密码</label>
                <div class="col-sm-9">
                    <input v-model="form.password" id="password" type="password" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" @click="_login">登录</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'login',
        is_login: false,
        data() {
            return {
                form: {
                    username: '',
                    password: ''
                }
            }
        },
        methods: {
            _login() {
                if (!this.form.username) {
                    return alert('请填写用户名');
                }
                if (!this.form.password) {
                    return alert('请填写密码');
                }
                var self = this;
                axios.post('api/login', this.form)
                    .then(function(res) {
                        var code = res.code;
                        var msg = res.msg;
                        if (code !== 0) {
                            alert(msg);
                        }
                        // 设置本地localStorage
                        var isLogin = localStorage.getItem('logged');
                        if (!isLogin) {
                            localStorage.setItem('logged', true);
//                            self.is_login = true;
                        }
                        self.$router.push({name: 'pets'})
                    })
            }
        }
    }
</script>

<style>
    .container {
        margin: 0 auto;
    }
</style>