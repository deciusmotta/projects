<template>
    <div id="list">
        <h1>Project list</h1>
        <loading v-show="loading"/>
        <table class="table table-bordered table-striped">
            <thead>
            <th>#</th>
            <th>Project</th>
            <th>Options</th>
            </thead>
            <tbody>
            <tr v-for="project in list" :key="project.id">
                <td>{{project.id}}</td>
                <td>{{project.name}}</td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Loading from '../Loading'
    import Vue from 'vue'

    export default {
        name: 'project-list',
        components: {Loading},
        data() {
            return {
                list: [],
                loading: false
            }
        },
        mounted() {
            this.loading = true
            this.getList()
        },
        methods: {
            getList() {
                this.$http.get('/project')
                    .then(this.fillList)
            },
            fillList(list) {
                Vue.set(this, 'list', list.data.data)
                this.loading = false
            }
        }
    }
</script>
<style scoped>
    #list
    {
        width: 100%;
    }
</style>
