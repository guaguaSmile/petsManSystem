<template>
    <div class="content-right col-10">
        <div class="row" style="margin: 10px 0px">

        </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>邮箱</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in users" v-bind:key="user.id">
                <th scope="row">{{ user.id}}</th>
                <td>{{ user.username}}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.created_at }}</td>
                <td>
                    <a href="#" class="btn btn-primary">修改</a>
                    <a href="javascript:;" class="btn btn-primary" @click="_delete(user.id)">删除</a>
                </td>
            </tr>
            </tbody>
        </table>
        <page></page>
    </div>
</template>


<script>
    export default {
        data() {
            return {
                users: [],
            }
        },
        created() {
            this._fetchData()
        },
        methods: {
            _fetchData() {
                fetch('/api/user')
                    .then(res => res.json())
                    .then(res => {
                        this.users = res.data
                    })
            },
            _delete(id) {
                axios.post('/api/user/'+id+'/delete')
                    .then(function(response) {
                        var code = response.code;
                        var msg = response.msg;
                        if (code !== 0) {
                            return alert(msg);
                        }
                        alert('删除成功');
                        setTimeout(() => {
                            window.location.reload();
                        }, 0)
                    })
                    .catch(function (e) {

                    })
            },
        }
    }
</script>

<style>
    .content-right {
        float: right;
        overflow: hidden;
    }
</style>