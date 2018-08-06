<template>
    <div class="content-right col-10">
        <div class="row">
            <h4>宠物修改</h4>
        </div>
        <div class="row" style="padding: 10px 15px;">
            <button class="btn btn-primary" id="btn-storePets" @click="_showTreatmentModal">添加治疗记录</button>
        </div>
        <div class="form">
            <button class="btn btn-default" disabled>宠物信息</button>
            <div class="form-group">
                <label for="petName">宠物名*</label>
                <input type="text" required v-model="form.name" class="form-control" id="petName" placeholder="宠物名">
            </div>
            <div class="checkbox">
                <label for="petGender">
                    公：
                    <input type="radio"  name="gender"  v-bind:value="form.gender" id="petGender" value="1">
                </label>
                <label for="petGenderf">
                    母：
                    <input type="radio" name="gender"  v-bind:value="form.gender" id="petGenderf" value="2">
                </label>
            </div>
            <div class="form-group">
                <label for="petColor">颜色*</label>
                <input type="text" v-model="form.color" class="form-control" id="petColor">
            </div>
            <div class="form-group">
                <label for="user">宠物主*</label>
                <input type="text" v-model="form.user" class="form-control" id="user" placeholder="例如：张三(18298361111)">
            </div>
            <button class="btn btn-default" disabled>治疗信息</button>
            <br/>
            <div class="form-group">
                <label>治疗时间*</label>
                <date-picker v-model="form.treatment_time" :config="options"></date-picker>
            </div>
            <div class="form-group">
                <label>下次治疗时间*</label>
                <date-picker v-model="form.next_treatment_time" :config="options"></date-picker>
            </div>
            <div class="form-group">
                <label>治疗内容*</label>
                <textarea v-model="form.content" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <a type="button" class="btn btn-default" href="/pets">返回</a>
                <button type="button" class="btn btn-primary" @click="_editPet">修改</button>
            </div>
        </div>
        <div class="modal" id="storeTreatmentModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">添加治疗记录</h4>
                        <button type="button" style="padding: 0px 10px" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <button class="btn btn-default" disabled>治疗信息</button>
                            <br/>
                            <div class="form-group">
                                <label>治疗时间*</label>
                                <date-picker v-model="treatment.treatment_time" :config="options"></date-picker>
                            </div>
                            <div class="form-group">
                                <label>下次治疗时间*</label>
                                <date-picker v-model="treatment.next_treatment_time" :config="options"></date-picker>
                            </div>
                            <div class="form-group">
                                <label>治疗内容*</label>
                                <textarea v-model="treatment.content" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" @click="_storeTreatment">添加</button>
                    </div>
                </div>
            </div>
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
                    name: '',
                    color: '',
                    user: '',
                    gender: ''  ,
                    next_treatment_time: new Date(),
                    treatment_time: new Date(),
                    content: '',
                },
                treatment: {
                    next_treatment_time: new Date(),
                    treatment_time: new Date(),
                    content: '',
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
                fetch("/api/pets/"+this.$route.params.id+"/edit")
                    .then(res => res.json())
                    .then(res => {
                        this.form = res.data
                    })
            },
            _showStorePetsModal() {
                $('#storePetsModal').modal()

            },
            _editPet() {
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
               /* if (!this.form.data.treatment_time) {
                    return alert('请选择治疗时间');
                }*/
                if (!this.form.content) {
                    return alert('请填写内容');
                }
                axios.post('/api/pets/'+this.$route.params.id+'/edit', this.form)
                    .then(function(response) {
                        var code = response.code;
                        var msg = response.msg;
                        if (code !== 0) {
                            return alert(msg);
                        }
                        alert('修改成功');
                       /* setTimeout(() => {
                            window.location.href="/pets";
                        }, 0)*/
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
            _showTreatmentModal() {
                $('#storeTreatmentModal').modal()
            },
            _storeTreatment() {
                var id = this.$route.params.id;
                var api = '/api/treatment/';
                this.treatment.id = id;
                axios.post(api,this.treatment).then(function (response) {
                    var code = response.code;
                    var msg = response.msg;
                    if (code !== 0) {
                        return alert(msg);
                    }
                    alert('删除成功');
                    setTimeout(() => {
                        window.location.href='';
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