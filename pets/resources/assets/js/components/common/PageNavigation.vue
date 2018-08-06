<template>
    <ul class="pagination" style="margin-top: 0px;">
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li v-if="count > 10">
            <!--<router-link :to="`/${api}?page=${n}`" v-for="n in 10" class="btn btn-primary">{{ n }}</router-link>-->
        </li>
        <li v-else="count < 10">
            <a v-for="n in count" class="btn btn-primary" v-on:click="$emit('_fetch-data', n)">{{ n }}</a>
            <!--<router-link :to="`/${api}?page=${n}`" v-for="n in count" class="btn btn-primary">{{ n }}</router-link>-->
        </li>
        <li>
            <a href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
        </li>
    </ul>
</template>

<script>
    export default {
        name: 'page',
        props:{
            api: String,
            count: Number,
        },
        data() {
            return {
            }
        },
        method: {

        }
    }
</script>