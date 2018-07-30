<template>
    <ul class="pagination" style="margin-top: 0px;">
        <li>
            <a href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li v-for="page in pages">
            <a href="#">page</a>
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
        data() {
            return {
               pages: 5,
            }
        },
        method: {

        }
    }
</script>