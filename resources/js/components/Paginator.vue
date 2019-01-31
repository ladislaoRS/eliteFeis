<template>
    <ul class="pagination pagination-sm justify-content-center" v-if="shouldPaginate">
        <li v-show="prevUrl" class="page-item" aria-label="Previous" rel="prev" @click.prevent="page--">
            <span class="page-link">&laquo; Previous</span>
        </li>
        <li v-show="nextUrl" class="page-item" aria-label="Next" rel="next" @click.prevent="page++">
            <span class="page-link">Next &raquo;</span>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['dataSet'],
        data() {
            return {
                page: 1,
                prevUrl: false,
                nextUrl: false
            }
        },
        watch: {
            dataSet() {
                this.page = this.dataSet.current_page;
                this.prevUrl = this.dataSet.prev_page_url;
                this.nextUrl = this.dataSet.next_page_url;
            },
            page() {
                this.broadcast().updateUrl();
            }
        },
        computed: {
            shouldPaginate() {
                return !! this.prevUrl || !! this.nextUrl;
            }
        },
        methods: {
            broadcast() {
                return this.$emit('changed', this.page);
            },
            updateUrl() {
                history.pushState(null, null, '?page=' + this.page);
            }
        }
    }
</script>