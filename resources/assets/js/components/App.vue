<template>
        <div id="app" class="container-fluid">
           <div class="row">
               <router-link :to="{path: '/projects'}">project</router-link>
           </div>
           <div class="row">
               <router-view/>
           </div>
        </div>
</template>

<script>
    export default {
        name: "app"
    }
</script>
