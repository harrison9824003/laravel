<template>
    <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
    <div class="row margin-bottom-40">        
        <!-- BEGIN SALE PRODUCT -->
        <div class="col-md-12 sale-product">
            <h2>New Arrivals</h2>
            <div class="owl-carousel owl-carousel5">           
                <div v-for="(product) in getSlice " :key="product.id">
                    <div class="product-item" >
                        <div class="pi-img-wrapper">                                            
                        <img :src="'/uploads/'+product.front.other.images[0].path" class="img-responsive" alt="Berry Lace Dress">
                        <div>
                            <a href="front/assets/pages/img/products/model1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                            <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                        </div>
                        </div>
                        <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                        <div class="pi-price">$29.00</div>
                        <a href="javascript:;" v-on:click="addCart(product.front.id, product.front.other.specs[0].category_id, 1)" class="btn btn-default add2cart">Add to cart</a>
                        <div class="sticker sticker-sale"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SALE PRODUCT -->
    </div>
    <!-- END SALE PRODUCT & NEW ARRIVALS -->
</template>

<script>
import {mapState, mapGetters, mapMutations, mapActions} from 'vuex'

export default {
    computed:{
        ...mapState('NewArrival', ['new_arrivals']),
        ...mapGetters('NewArrival', ['getSlice'])
    },
    methods:{
        // ...mapMutations({getARRIVAL:'GETNEWARRIVAL'}),
        // ...mapActions({getProducts:'getNewArrival'})
        addCart(product_id, spec_id, number){
            this.$store.dispatch('Cart/addCart', {
                product_id,
                spec_id,
                number
            });
        }
    },
    mounted(){
        console.log('new arrivals component mounted')
        Promise.all(
            [this.$store.dispatch('NewArrival/getNewArrival', '1')]
        ).then(()=>{
            
            this.$nextTick(function () {
                
                
            })
        })
        //this.getProducts(5)
    },
    updated() {
        console.log('update')
        $(".owl-carousel5").owlCarousel({
                    pagination: false,
                    navigation: true,
                    items: 5,
                    addClassActive: true,
                    itemsCustom : [
                        [0, 1],
                        [320, 1],
                        [480, 2],
                        [660, 2],
                        [700, 3],
                        [768, 3],
                        [992, 4],
                        [1024, 4],
                        [1200, 5],
                        [1400, 5],
                        [1600, 5]
                    ],
                });
    }
}
</script>