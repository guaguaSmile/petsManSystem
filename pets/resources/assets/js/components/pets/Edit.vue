<template>
    <div class="content-right col-10">
        <div>
            <div class="form-group">
                <label for="petName">宠物名*</label>
                <input type="text" required v-bind:value="form.data.name" class="form-control" id="petName" placeholder="宠物名">
            </div>
            <div class="checkbox">
                <label for="petGender">
                    公：
                    <input type="radio" v-model="form.gender" id="petGender" value="1">
                </label>
                <label for="petGenderf">
                    母：
                    <input class="date" type="radio" v-model="form.gender" id="petGenderf" value="2">
                </label>
            </div>
            <div class="form-group">
                <label for="petColor">颜色*</label>
                <input type="text" v-bind:value="form.data.color" class="form-control" id="petColor">
            </div>
            <div class="form-group">
                <label for="user">宠物主*</label>
                <input type="text" v-model="form.data.user" class="form-control" id="user" placeholder="例如：张三(18298361111)">
            </div>
            <hr/>
            <button class="btn btn-default" disabled>治疗信息</button>
            <br/>
            <div class="form-group">
                <label>治疗时间*</label>
                <date-picker v-bind:value="form.data.treatment_time" :config="options"></date-picker>
            </div>
            <div class="form-group">
                <label>下次治疗时间*</label>
                <date-picker v-bind:value="form.data.next_treatment_time" :config="options"></date-picker>
            </div>
            <div class="form-group">
                <label>治疗内容*</label>
                <textarea v-bind:value="form.data.content" class="form-control"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary" @click="_storePet">添加</button>
        </div>
    </div>
</template>


<script>
    import $ from "jquery";
    import datePicker from 'vue-bootstrap-datetimepicker';
    export default {
        name: "pets",
        props: {
            id: null
        },
        data() {
            return {
                pets: {},
                category: [],
                options: {
                    format: 'YYYY-MM-DD',
                    useCurrent: false,
                },
                form: {
                    data: {
                        name: '',
                        color: '',
                        user: '',
                        gender: '',
                        next_treatment_time: new Date(),
                        treatment_time: new Date(),
                        content: '',
                    }
                }
            }
        },
        created() {
            this._fetchData()
        },
        mounted() {
            this.init()
        },
        computed: {

        },
        methods: {
            _fetchData() {
                var self = this;
                axios.get("/api/pets/"+this.$route.params.id+"/edit").then(function (response) {
                    var code = response.code;
                    var msg = response.msg;
                    self.$data.form = response.data
                })
            },
            _showStorePetsModal() {
                $('#storePetsModal').modal()

            },
            _storePet() {
                if (!this.form.name) {
                    return alert('请填写宠物名');
                }
                if (!this.form.color) {
                    return alert('请填写颜色');
                }
                if (!this.form.user) {
                    return alert('请填写用户');
                }
                if (!this.form.gender) {
                    return alert('请选择宠物性别');
                }
                if (!this.form.next_treatment_time) {
                    return alert('请选择下次治疗时间');
                }
                if (!this.form.treatment_time) {
                    return alert('请选择治疗时间');
                }
                if (!this.form.content) {
                    return alert('请填写内容');
                }
                axios.post('api/pets', this.form)
                    .then(function(response) {
                        var code = response.code;
                        var msg = response.msg;
                        if (code !== 0) {
                            alert(msg);
                        }
                        alert('添加成功');
                        setTimeout(() => {
                            window.location.reload();
                        }, 0)
                    })
                    .catch(function (e) {

                    })
            },
            _deletePet(id) {
                var api = 'api/pets/'+id+'/delete';
                axios.post(api,{}).then(function (response) {
                    var code = response.code;
                    var msg = response.msg;
                    if (code !== 0) {
                        return alert(msg);
                    }
                    alert('删除成功');
                    setTimeout(() => {
                        window.location.reload();
                    }, 0)
                }).catch()

            },
            init() {
            }
        },
        components: {
            datePicker
        }
    }
</script>

<style>
    .content-right {
        float: right;
        overflow: hidden;
    }
</style>