<template>
    <div>
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
</template>
<script>
    export default {        
        mounted(){
            console.log('new arrival item component mounted')
        }
    }
</script>