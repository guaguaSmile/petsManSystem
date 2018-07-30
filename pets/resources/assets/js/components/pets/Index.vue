<template>
    <div class="content-right col-10">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>宠物名</th>
                <th>分类</th>
                <th>颜色</th>
                <th>公母</th>
                <th>用户</th>
                <th>上次治疗时间</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="pet in pets" v-bind:key="pet.id">
                <th scope="row">{{ pet.id}}</th>
                <td>{{ pet.name}}</td>
                <td>{{ pet.category }}</td>
                <td>{{ pet.color }}</td>
                <td>{{ pet.gender }}</td>
                <td>{{ pet.user.name }}</td>
                <td> </td>
                <td>{{ pet.created_at }}</td>
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
                pets: [],
                category: []
            }
        },
        created() {
            this._fetchData()
        },
        methods: {
            _fetchData() {
                fetch('api/pets')
                    .then(res => res.json())
                    .then(res => {
                        this.pets = res.pets
                        this.category = res.category
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