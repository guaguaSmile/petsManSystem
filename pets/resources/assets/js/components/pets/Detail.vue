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
                <td>{{ pet.created_at }}</td>
            </tr>
            </tbody>
        </table>
        <h3>治疗记录</h3>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>治疗时间</th>
                <th>下次治疗时间</th>
                <th>治疗内容</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="treatment in treatments">
                <td>{{ treatment.id}}</td>
                <td>{{ treatment.treatment_time }}</td>
                <td>{{ treatment.next_treatment_time }}</td>
                <td>{{ treatment.content }}</td>
                <td>{{ treatment.created_at }}</td>
                <td>
                    <button class="btn btn-warning" @click="_deleteTreatment(treatment.id)">删除</button>
                </td>
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
                treatments: []
            }
        },
        created() {
            this._fetchData()
        },
        mounted() {

        },
        methods: {
            _fetchData() {
                fetch('/api/pets/'+this.$route.params.id+'/detail')
                    .then(res => res.json())
                    .then(res => {
                        this.pet = res.data.pet
                        this.treatments = res.data.pet.treatments
                    })
            },
            _deleteTreatment(id) {
                var self = this;
                axios.post('/api/treatment/'+id+'/delete')
                    .then(function(response) {
                        var code = response.code;
                        var msg = response.msg;
                        if (code !== 0) {
                            return alert(msg);
                        }
                        alert('删除成功');
                        setTimeout(() => {
                            self.$router.push({name: 'petsDetail', params: {id: id}})
                        }, 0)
                    })
                    .catch(function (e) {

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