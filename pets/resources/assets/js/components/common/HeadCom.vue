<template>
    <div>
        <nav class="nav navbar navbar-expand navbar-dark bg-info" role="navigation" style="margin-bottom: 0px">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">宠物管理系统</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#">通知</a></li>
                        <li><a href="#">Link</a></li>
                        <li><a href="#">admin</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</template>

<script>
    export default {
        name: 'HeadCom',
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style>

</style>
