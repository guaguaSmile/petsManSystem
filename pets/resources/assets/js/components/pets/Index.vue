<template>
    <div class="content-right col-10">
        <div class="row" style="margin: 10px 0px">
            <a class="btn btn-primary" id="btn-storePets" @click="_showStorePetsModal">添加</a>
            <input type="text" v-model="keyword" class="input" id="exampleInputName2" placeholder="宠物名，用户名" style="margin: 0px 10px;">
            <button type="submit" class="btn btn-primary" @click="_fetchData(1, keyword)">搜索</button>
        </div>
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
            <tr v-for="pet in pets">
                <th scope="row">{{ pet.id}}</th>
                <td>{{ pet.name}}</td>
                <td>{{ pet.category }}</td>
                <td>{{ pet.color }}</td>
                <td>{{ pet.gender }}</td>
                <td>{{ pet.user }}</td>
                <td>{{ pet.treatment.treatment_time }}</td>
                <td>{{ pet.created_at }}</td>
                <td>
                    <router-link :to="`pets/${pet.id}/edit`" class="btn btn-primary">修改</router-link>
                    <a href="#" class="btn btn-warning" @click="_deletePet(pet.id)" :id="pet.id">删除</a>
                    <router-link :to="`pets/${pet.id}/detail`" class="btn btn-primary">查看</router-link>
                </td>
            </tr>
            </tbody>
        </table>
        <page v-bind:count="count" v-on:_fetch-data="_fetchData"></page>
        <div class="modal" id="storePetsModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">添加宠物信息</h4>
                        <button type="button" style="padding: 0px 10px" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <div class="form-group">
                                <label for="petName">宠物名*</label>
                                <input type="text" required v-model="form.name" class="form-control" id="petName" placeholder="宠物名">
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
                                <input type="text" v-model="form.color" class="form-control" id="petColor">
                            </div>
                            <div class="form-group">
                                <label for="user">宠物主*</label>
                                <input type="text" v-model="form.user" class="form-control" id="user" placeholder="例如：张三(18298361111)">
                            </div>

                            <hr/>
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
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" @click="_storePet">添加</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import $ from "jquery";
    import datePicker from 'vue-bootstrap-datetimepicker';
    import page from '../common/PageNavigation.vue';
    export default {
        name: "pets",
        props: {
        },
        data() {
            return {
                pets: [],
                category: [],
                options: {
                    format: 'YYYY-MM-DD',
                    useCurrent: false,
                },
                form: {
                    name: '',
                    color: '',
                    user: '',
                    gender: '',
                    next_treatment_time: new Date(),
                    treatment_time: new Date(),
                    content: '',
                },
                count: null,
                api: 'pets',
                keyword: '',
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
            testD() {
//                console.log(111)
            },
            _fetchData(page, keyword) {
                var flag = 0;
                var api = '/api/pets';
//                formData.append('page', page);
                if (page && page !== 'undefined') {
                    api += '?page=' + page;
                    flag++;
                }
                if (keyword) {
                    if (flag >=1) {
                        api += '&keyword='+keyword;
                    } else {
                        api += '?keyword='+keyword;
                    }
                }
                fetch(api).then(res => res.json())
                    .then(res => {
                        console.log(this)
                        console.log(self);
                        this.$data.pets = res.pets
                        this.$data.category = res.category
                        this.$data.count = res.count
                    })
//                console.log(this)
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
                axios.post('/api/pets', this.form)
                    .then(function(response) {
                        var code = response.code;
                        var msg = response.msg;
                        if (code !== 0) {
                            return alert(msg);
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
                var api = '/api/pets/'+id+'/delete';
                axios.post(api,{}).then(function (response) {
                    var code = response.code;
                    var msg = response.msg;
                    if (code !== 0) {
                        alert(msg);
                    }
                    alert('删除成功');
                    setTimeout(() => {
                        window.location.reload();
                    }, 0)
                })

            },
            init() {
            }
        },
        components: {
            datePicker,
            page
        }
    }
</script>

<style>
    .content-right {
        float: right;
        overflow: hidden;
    }
</style>