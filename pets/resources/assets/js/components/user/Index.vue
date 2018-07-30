<template>
    <div class="content-right col-10">
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
                <td>{{ user.name}}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.created_at }}</td>
                <td>
                    <a href="#" class="btn btn-primary">修改</a>
                    <a href="#" class="btn btn-primary">删除</a>
                </td>
            </tr>
            </tbody>
            <page></page>
        </table>

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
                fetch('api/user')
                    .then(res => res.json())
                    .then(res => {
                        this.users = res.data
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