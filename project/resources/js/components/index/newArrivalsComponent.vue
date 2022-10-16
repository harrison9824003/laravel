<template>
    <!-- BEGIN SALE PRODUCT & NEW ARRIVALS -->
    <div class="row margin-bottom-40">
        <!-- BEGIN SALE PRODUCT -->
        <div class="col-md-12 sale-product">
        <h2>New Arrivals</h2>
        <div class="owl-carousel owl-carousel5">
            <div v-for="(product) in getSlice " :key="product.id" style="width:194px">
                <div class="product-item" >
                    <div class="pi-img-wrapper">                        
                    <img :src="product.front.other.images[0].path" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                        <a href="front/assets/pages/img/products/model1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                        <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                    </div>
                    <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                    <div class="pi-price">$29.00</div>
                    <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                    <div class="sticker sticker-sale"></div>
                </div>
            </div>            
            <!-- <div>
                <div class="product-item">
                    <div class="pi-img-wrapper">
                    <img src="front/assets/pages/img/products/model1.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                        <a href="front/assets/pages/img/products/model1.jpg" class="btn btn-default fancybox-button">Zoom</a>
                        <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                    </div>
                    <h3><a href="shop-item.html">Berry Lace Dress</a></h3>
                    <div class="pi-price">$29.00</div>
                    <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                    <div class="sticker sticker-sale"></div>
                </div>
            </div>
            <div>
                <div class="product-item">
                    <div class="pi-img-wrapper">
                    <img src="front/assets/pages/img/products/model2.jpg" class="img-responsive" alt="Berry Lace Dress">
                    <div>
                        <a href="front/assets/pages/img/products/model2.jpg" class="btn btn-default fancybox-button">Zoom</a>
                        <a href="#product-pop-up" class="btn btn-default fancybox-fast-view">View</a>
                    </div>
                    </div>
                    <h3><a href="shop-item.html">Berry Lace Dress2</a></h3>
                    <div class="pi-price">$29.00</div>
                    <a href="javascript:;" class="btn btn-default add2cart">Add to cart</a>
                </div>
            </div> -->
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
        ...mapState('newArrival', ['new_arrivals']),
        ...mapGetters('newArrival', ['getSlice'])
    },
    methods:{
        ...mapMutations({getARRIVAL:'GETNEWARRIVAL'}),
        ...mapActions({getProducts:'getNewArrival'})
    },
    mounted(){
        console.log('new arrivals component mounted')
        this.$store.dispatch('newArrival/getNewArrival', '5')
        //this.getProducts(5)
    }
}
</script>