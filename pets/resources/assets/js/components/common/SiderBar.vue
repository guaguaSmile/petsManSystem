<template>
    <div class="col-2 msider-bar" style="float: left" >
       <div class="sidebar-nav">
           <br/>
           <ul>
               <li>
                   <a href="#table-menu" data-toggle="collapse"><i class="glyphicon glyphicon-user"></i>用户管理</a>
                   <ul id="table-menu" class="nav nav-list collapse">
                       <li ><a href="user">系统用户</a></li>
                   </ul>
               </li>
               <li>
                   <a href="#menu-menu" data-toggle="collapse"><i class="icon-reorder"></i>宠物管理</a>
                   <ul id="menu-menu" class="nav nav-list collapse">
                       <li ><a href="pets">宠物列表</a></li>
                   </ul>
               </li>
               <li>
                   <a href="#order-menu" data-toggle="collapse"><i class="icon-th-large"></i>分类管理</a>
                   <ul id="order-menu" class="nav nav-list collapse">
                       <li ><a href="category">分类列表</a></li>
                   </ul>
               </li>
           </ul>
        </div>
    </div>
</template>

<script>
//    $('.collapse').collapse()
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            _showSubject () {

            }
        },

    }
</script>

<style>
    ul, li{
        margin: 0;
        padding: 0;
    }
    li {
        list-style: none;
    }
    .msider-bar {
        background-color: #e6e6e6;
    }
    .msider-bar ul li {
        /*height: 30px;*/
    }
</style>
