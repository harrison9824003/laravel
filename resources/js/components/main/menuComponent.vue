<template>
    <div>
        <!-- BEGIN TOP BAR -->
        <div class="pre-header">
            <div class="container">
                <div class="row">
                    <!-- BEGIN TOP BAR LEFT PART -->
                    <div class="col-md-6 col-sm-6 additional-shop-info">
                        <ul class="list-unstyled list-inline">
                            <li><i class="fa fa-phone"></i><span>+1 456 6717</span></li>
                            <!-- BEGIN CURRENCIES -->
                            <li class="shop-currencies">
                                <a href="javascript:void(0);">€</a>
                                <a href="javascript:void(0);">£</a>
                                <a href="javascript:void(0);" class="current">$</a>
                            </li>
                            <!-- END CURRENCIES -->
                            <!-- BEGIN LANGS -->
                            <li class="langs-block">
                                <a href="javascript:void(0);" class="current">English </a>
                                <div class="langs-block-others-wrapper"><div class="langs-block-others">
                                <a href="javascript:void(0);">French</a>
                                <a href="javascript:void(0);">Germany</a>
                                <a href="javascript:void(0);">Turkish</a>
                                </div></div>
                            </li>
                            <!-- END LANGS -->
                        </ul>
                    </div>
                    <!-- END TOP BAR LEFT PART -->
                    <!-- BEGIN TOP BAR MENU -->
                    <div class="col-md-6 col-sm-6 additional-nav">
                        <ul class="list-unstyled list-inline pull-right">
                            <li><a href="shop-account.html">My Account</a></li>
                            <li><a href="shop-wishlist.html">My Wishlist</a></li>
                            <li><a href="shop-checkout.html">Checkout</a></li>
                            <li><router-link active-class="active" to="/member">Log In</router-link></li>
                        </ul>
                    </div>
                    <!-- END TOP BAR MENU -->
                </div>
            </div>        
        </div>
        <!-- END TOP BAR -->

        <!-- BEGIN HEADER -->
        <div class="header">
        <div class="container">
            <a class="site-logo" href="shop-index.html"><img src="front/assets/corporate/img/logos/logo-shop-red.png" alt="Metronic Shop UI"></a>

            <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>

            <!-- BEGIN CART -->
            <div class="top-cart-block">
            <div class="top-cart-info">
                <a href="javascript:void(0);" class="top-cart-info-count">3 items</a>
                <a href="javascript:void(0);" class="top-cart-info-value">$1260</a>
            </div>
            <i class="fa fa-shopping-cart"></i>
                            
            <div class="top-cart-content-wrapper">
                <div class="top-cart-content">
                <ul class="scroller" style="height: 250px;">
                    <li>
                    <a href="shop-item.html"><img src="front/assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                    <span class="cart-content-count">x 1</span>
                    <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
                    <em>$1230</em>
                    <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                    </li>
                    <li>
                    <a href="shop-item.html"><img src="front/assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                    <span class="cart-content-count">x 1</span>
                    <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
                    <em>$1230</em>
                    <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                    </li>
                    <li>
                    <a href="shop-item.html"><img src="front/assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                    <span class="cart-content-count">x 1</span>
                    <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
                    <em>$1230</em>
                    <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                    </li>
                    <li>
                    <a href="shop-item.html"><img src="front/assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                    <span class="cart-content-count">x 1</span>
                    <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
                    <em>$1230</em>
                    <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                    </li>
                    <li>
                    <a href="shop-item.html"><img src="front/assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                    <span class="cart-content-count">x 1</span>
                    <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
                    <em>$1230</em>
                    <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                    </li>
                    <li>
                    <a href="shop-item.html"><img src="front/assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                    <span class="cart-content-count">x 1</span>
                    <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
                    <em>$1230</em>
                    <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                    </li>
                    <li>
                    <a href="shop-item.html"><img src="front/assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                    <span class="cart-content-count">x 1</span>
                    <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
                    <em>$1230</em>
                    <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                    </li>
                    <li>
                    <a href="shop-item.html"><img src="front/assets/pages/img/cart-img.jpg" alt="Rolex Classic Watch" width="37" height="34"></a>
                    <span class="cart-content-count">x 1</span>
                    <strong><a href="shop-item.html">Rolex Classic Watch</a></strong>
                    <em>$1230</em>
                    <a href="javascript:void(0);" class="del-goods">&nbsp;</a>
                    </li>
                </ul>
                <div class="text-right">
                    <a href="shop-shopping-cart.html" class="btn btn-default">View Cart</a>
                    <a href="shop-checkout.html" class="btn btn-primary">Checkout</a>
                </div>
                </div>
            </div>            
            </div>
            <!--END CART -->

            <!-- BEGIN NAVIGATION -->
            <div class="header-navigation">
            <ul>
                <li v-for="(menu) in meun_data" :key="menu.id">
                    <template v-if="!menu.childen_cnt">
                        <a href="#" target="_blank">{{ menu.name }}</a>
                        <router-link :to="{path: '/category/'+menu.id}">{{ menu.name }}</router-link>
                    </template>
                    <template v-else>
                        <a class="dropdown-toggle" data-toggle="dropdown" data-target="#" href="javascript:;">
                            {{ menu.name }}
                        </a>
                        <ul class="dropdown-menu">
                            <li v-for="(sub_menu) in menu.childen" :key="sub_menu.id">
                                <router-link :to="{path: '/category/'+sub_menu.id}">{{ sub_menu.name }}</router-link>
                            </li>
                        </ul>
                    </template>
                </li>
                <!-- BEGIN TOP SEARCH -->
                <li class="menu-search">
                <span class="sep"></span>
                <i class="fa fa-search search-btn"></i>
                <div class="search-box">
                    <form action="#">
                    <div class="input-group">
                        <input type="text" placeholder="Search" class="form-control">
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                    </form>
                </div> 
                </li>
                <!-- END TOP SEARCH -->
            </ul>
            </div>
            <!-- END NAVIGATION -->
        </div>
        </div>
        <!-- Header END -->
    </div>
</template>

<script>
import {mapState, mapGetters} from 'vuex'
export default {
    computed:{
        ...mapState('Menu', ['meun_data'])
    },
    mounted() {
        console.log('menu component mounted')        
        this.$store.dispatch('Menu/getMenu')
        this.$store.dispatch('Member/loadMember')
    }
}
</script>