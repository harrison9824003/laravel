<template>
    <div>
        <h2>{{ $route.params.category }}</h2>
        <p>{{ ($route.params.page) ? $route.params.page : '' }}</p>
    </div>    
</template>