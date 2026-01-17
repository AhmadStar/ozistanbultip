<template>
    <div class="col-sm-8 col-lg-6 mt-2 mt-lg-0 order-1 order-sm-0">
        <div class="reviews-wrap ml-auto d-flex flex-column justify-content-center">
            <div class="title-wrap text-center text-md-right">
                <div class="h-sub">What People Says</div>
                <h2 class="h1">Patient <span class="theme-color">Testimonials</span></h2>
            </div>
            <div class="js-reviews-carousel reviews-carousel text-center text-md-right">
                <div class="review" v-for="item in data">
                    <p class="review-text" v-html="item.content"></p>
                    <p><span class="review-author">- {{ item.name }},</span> <span class="review-author-position">{{ item.company }}</span></p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: function () {
        return {
            isLoading: true,
            data: []
        };
    },
    props: {
        url: {
            type: String,
            default: () => null,
            required: true
        },
    },
    mounted() {
        this.getData();
    },
    methods: {
        getData() {
            this.data = [];
            this.isLoading = true;
            axios.get(this.url)
                .then(res => {
                    this.data = res.data.data ? res.data.data : [];
                    this.isLoading = false;
                })
                .catch(res => {
                    this.isLoading = false;
                    console.log(res);
                });
        },
    },
}
</script>
