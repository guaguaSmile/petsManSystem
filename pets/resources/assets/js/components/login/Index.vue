<template>
    <div class="container">
        <div>
            <div class="form-group">
                <label for="username">用户名</label>
                <input v-model="form.username" id="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">密码</label>
                <input v-model="form.password" id="password" type="password" class="form-control">
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