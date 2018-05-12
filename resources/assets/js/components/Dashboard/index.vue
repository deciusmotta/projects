<template>
    <div>
      <v-dialog v-model="dialog" max-width="500px" fullscreen transition="dialog-bottom-transition" :overlay="false">
        <v-btn color="primary" dark slot="activator" class="mb-2">{{ newItemText}}</v-btn>
        <v-card>
          <v-card-title>
            <span class="headline">{{ formTitle }}</span>
          </v-card-title>
          <v-card-text>
            <v-container grid-list-md>

              
            
            </v-container>
          </v-card-text>
          
        </v-card>
      </v-dialog>
    </div>
</template>

<script>
    import Vue from 'vue'

    export default {
        
        data() {
            return {
             
            }
        },
        props: {
         
        },
        mounted() {
           
        },
        methods: {
           
        },
        computed: {
           
        },
        watch: {
            
        },
    }
</script>
<style scoped>
    
</style>
