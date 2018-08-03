<template>
    <div class="content-right col-10">
        <h3>宠物信息</h3>
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
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{ pet.id}}</th>
                <td>{{ pet.name}}</td>
                <td>{{ pet.category }}</td>
                <td>{{ pet.color }}</td>
                <td>{{ pet.gender }}</td>
                <td>{{ pet.user }}</td>
                <td> xx</td>
                <td>{{ pet.created_at }}</td>
            </tr>
            </tbody>
        </table>
        <h3>治疗记录</h3>
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
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">{{ pet.id}}</th>
                <td>{{ pet.name}}</td>
                <td>{{ pet.category }}</td>
                <td>{{ pet.color }}</td>
                <td>{{ pet.gender }}</td>
                <td>{{ pet.user }}</td>
                <td> xx</td>
                <td>{{ pet.created_at }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pet: {},
                treatment: []
            }
        },
        created() {

        },
        mounted() {
            this.init()
        },
        methods: {
            init() {

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