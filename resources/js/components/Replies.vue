<template>
    <div>
        <div class="comments-area" v-if="items.length">
            <div class="comment-list" v-for="(reply, index) in items" :key="reply.id">
                <reply :data="reply" @deleted="remove(index)"></reply>
            </div>
            <paginator :dataSet="dataSet" @changed="fetch"></paginator>
        </div>
        <div class="comments-area" v-else>
            <p class="text-center text-muted">This post has no replies yet!</p>
        </div>
        <div class="comment-form">
            <h4>Leave a Reply</h4>
            <new-reply @created="add"></new-reply>
        </div>
    </div>
</template>

<script>
    import Reply from './Reply.vue';
    import NewReply from './NewReply.vue';
    import collection from '../mixins/collection';

    export default {
        components: { Reply, NewReply },
        mixins: [collection],

        data() {
            return { dataSet: false, repliesCount: 0 };
        },
        created() {
            this.fetch();
        },
        methods: {
            fetch(page) {
                axios.get(this.url(page)).then(this.refresh);
            },
            url(page) {
                if (! page) {
                    let query = location.search.match(/page=(\d+)/);
                    page = query ? query[1] : 1;
                }
                return `${location.pathname}/replies?page=${page}`;
            },
            refresh({data}) {
                this.dataSet = data;
                this.items = data.data;
            }
        }
    }
</script>
