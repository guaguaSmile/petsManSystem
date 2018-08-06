<template>
    <div class="content-right col-10">
        <div class="row"  style="margin: 10px 0px">
            <a class="btn btn-primary" href="javascript:;" id="btn-storePets" @click="_showStoreCategoryModal">添加</a>
            <input type="text" v-model="keyword" class="input" id="exampleInputName2" placeholder="分类名" style="margin: 0px 10px;">
            <button type="submit" class="btn btn-primary" @click="_searchData">搜索</button>
        </div>
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
                    <a href="javascript:;" class="btn btn-primary" @click="_delete(mcate.id)">删除</a>
                </td>
            </tr>
            </tbody>
        </table>
        <page></page>
        <div class="modal" id="storeCategoryModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">添加宠物信息</h4>
                        <button type="button" style="padding: 0px 10px" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="categoryName">分类名*</label>
                                <input type="text" required v-model="form.name" class="form-control" id="categoryName">
                            </div>
                            <div class="form-group">
                                <label for="categoryName">父级分类</label>
                                <select v-model="form.pid" class="form-control">
                                    <option value="">--</option>
                                    <option v-for="tcategory in tcategorys" v-bind:value="tcategory.id">{{ tcategory.name}}</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" @click="_storeCategory">添加</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import $ from "jquery";
    export default {
        data() {
            return {
                mcategorys: [], // 首页数据
                tcategorys: [], // 顶级分类存储
                form: {         // 添加分类
                    name: '',
                    pid: ''
                },
                keyword: '',
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
            },
            _showStoreCategoryModal() {
                $('#storeCategoryModal').modal() // jquery 显示modal
                fetch('/api/category/store')
                    .then(res => res.json())
                    .then(res => {
                        this.tcategorys = res.data
                    }).catch(err => {
                    console.log(err)
                })
            },
            _storeCategory() {
                if (!this.form.name) {
                    return alert('请填写分类名')
                }
                axios.post('api/category/store', this.form).then(function (response) {
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
            },
            _delete(id) {
                axios.post('api/category/'+id+'/delete').then(function (response) {
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
        }
    }
</script>

<style>
    .content-right {
        float: right;
        overflow: hidden;
    }
</style>