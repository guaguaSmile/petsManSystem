<template>
    <div class="content-right col-10">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>名称</th>
                <th>pid</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="mcate in mcategorys" v-bind:key="mcate.id">
                <th scope="row">{{ mcate.id}}</th>
                <td>{{ mcate.name}}</td>
                <td>{{ mcate.pid }}</td>
                <td>{{ mcate.created_at }}</td>
                <td>
                    <a href="#" class="btn btn-primary">修改</a>
                    <a href="#" class="btn btn-primary">删除</a>
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
                mcategorys: []
            }
        },
        created() {
            this._fetchData()
        },
        methods: {
            _fetchData() {
                fetch('api/category')
                    .then(res => res.json())
                    .then(res => {
                        this.mcategorys = res.data
                    }).catch(err => {
                        console.log(err)
                })
            }
        }
    }
</script>

<style>
    .content-right {
        float: right;
        overflow: hidden;
    }
</style>