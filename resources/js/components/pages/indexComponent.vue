<template>
    <div>
        <SliderComponent></SliderComponent>
        <ContentComponent></ContentComponent>
        <SetpsComponent></SetpsComponent>
    </div>    
</template>

<script>
import SliderComponent from '../index/sliderComponent.vue'
import SetpsComponent from '../index/setpsComponent.vue'
import ContentComponent from '../index/contentComponent.vue'
export default {
    mounted() {
        console.log("index component mounted")
        
    },
    components:{
        SliderComponent,
        SetpsComponent,
        ContentComponent
    }
}
</script>