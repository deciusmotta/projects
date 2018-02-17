<template>
    <div>
    <v-dialog v-model="dialog" max-width="500px" fullscreen transition="dialog-bottom-transition" :overlay="false">
      <v-btn color="primary" dark slot="activator" class="mb-2">Novo Projeto</v-btn>
      <v-card>
        <v-card-title>
          <span class="headline">{{ formTitle }}</span>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm12 md12>
                <v-text-field label="Nome" v-model="editedItem.name"></v-text-field>
              </v-flex>              
            </v-layout>
            <v-layout row>
                <v-flex xs12 sm12 md12>
                    <v-text-field label="Descrição" v-model="editedItem.description" textarea></v-text-field>
                </v-flex>              
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click.native="close">Cancelar</v-btn>
          <v-btn color="blue darken-1" flat @click.native="save">Salvar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-card>
        <v-card-title>
        Projetos
        <v-spacer></v-spacer>
        <v-text-field
            append-icon="search"
            label="Pesquisar"
            single-line
            hide-details
            v-model="search"
        ></v-text-field>
        </v-card-title>
        <v-data-table
            :headers="headers"
            :items="items"
            :search="search"
            :pagination.sync="pagination"
            :total-items="totalItems"
            :loading="loading"
            :must-sort=mustSort
        >
        <template slot="items" slot-scope="props">
            <td>{{ props.item.id }}</td>
            <td>{{ props.item.name }}</td>
            <td class="justify-center layout px-0">
                <v-btn icon class="mx-0" @click="editItem(props.item)">
                    <v-icon color="teal">edit</v-icon>
                </v-btn>
                <v-btn icon class="mx-0" @click="deleteItem(props.item)">
                    <v-icon color="pink">delete</v-icon>
                </v-btn>
            </td>
        </template>
        <v-alert slot="no-results" :value="true" color="error" icon="warning">
            Your search for "{{ search }}" found no results.
        </v-alert>
        </v-data-table>
    </v-card>
    <v-layout row justify-center>
        <v-btn color="primary" dark @click.native.stop="confirmation = true">Open Dialog</v-btn>
        <v-dialog v-model="confirmation" max-width="290">
        <v-card>
            <v-card-title class="headline">Excluir Item?</v-card-title>
            <v-card-text> Esta ação não poderá ser disfeita.</v-card-text>
            <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="green darken-1" flat="flat" @click.native="confirmation = false">Não</v-btn>
            <v-btn color="green darken-1" flat="flat" @click.native="destroyItem">Sim</v-btn>
            </v-card-actions>
        </v-card>
        </v-dialog>
    </v-layout>
    <v-snackbar
      :timeout="timeout"
      :color="color"          
      v-model="snackbar"
    >
      {{ message }}
      <v-btn dark flat @click.native="snackbar = false"><v-icon color="teal">close</v-icon></v-btn>
    </v-snackbar>
    </div>
</template>

<script>
    import Vue from 'vue'

    export default {
        name: 'project-list',
        data() {
            return {
                items: [],
                message: '',
                editedIndex: -1,
                loading: true,
                search: '',
                pagination: {},
                totalItems: 0,
                mustSort: true,
                color: '',
                timeout: 3000,
                snackbar: false,
                confirmation: false,
                itemToBeDeleted: 0,
                itemToBeDeletedIndex: 0,
                headers: [
                    { text: 'Id', value: 'id' },                    
                    { text: 'Nome', value: 'name'},
                    { text: 'Ações', value: '', sortable: false},
                ],
                dialog: false,
                editedItem: {
                    id: 0,
                    name: '',
                    description: ''
                },
                defaultItem: {
                    name: '',
                    description: ''
                }
            }
        },
        mounted() {
            
        },
        methods: {
            getList(search, sortBy, page, rowsPerPage, descending) {
                if(this.pagination.sortBy != undefined){
                    this.$http.get('/project', {
                        params: {
                            'search':search,
                            'sortBy': sortBy,
                            'descending': descending,
                            'page': page,
                            'perPage': rowsPerPage
                        }
                    }).then(this.fillList).catch(this.catchLoad)
                }                
            },
            catchLoad (error) {
                console.error(error)
                this.loading = false
            },
            fillList(list) {
                this.loading = true
                Vue.set(this, 'items', list.data.data)
                Vue.set(this, 'totalItems', list.data.total)
                this.loading = false
            },
            editItem (item) {
                this.editedIndex = this.items.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },
            deleteItem (item) {
                const index = this.items.indexOf(item)
                this.itemToBeDeleted = this.items[index].id
                this.itemToBeDeletedIndex = index
                this.confirmation = true
                
                /*confirm('Are you sure you want to delete this item?') && this.items.splice(index, 1)*/
            },
            close () {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },
            save () {
                if (this.editedIndex > -1) {
                    Object.assign(this.items[this.editedIndex], this.editedItem)
                    this.updateItem(this.editedItem)
                } else {                    
                    this.newItem(this.editedItem)
                }
                this.close()
            },
            newItem (newItem) {
                this.$http.post('/project', {                        
                        'name': newItem.name,
                        'description': newItem.description                    
                    }).then( data => {
                        console.log(data)
                        this.items.push(data.data)
                        this.color = 'success'
                        this.message = "Item salvo com sucesso"
                        this.snackbar = true
                    })
                
            },
            updateItem (updatedItem) {
                this.$http.put('/project/' + updatedItem.id, {                        
                        'name': updatedItem.name,
                        'description': updatedItem.description                    
                    }).then( data => {
                        console.log(data)
                        this.items.push(data.data)
                        this.color = 'success'
                        this.message = "Item atualizado com sucesso"
                        this.snackbar = true
                    })
            },
            destroyItem () {
                this.$http.delete('/project/' + this.itemToBeDeleted).then( data => {
                        console.log(data)
                        //this.items.push(data.data)
                        this.color = 'success'
                        this.message = "Item deletado com sucesso"
                        this.snackbar = true
                        this.items.splice(this.itemToBeDeletedIndex, 1)
                        
                        this.itemToBeDeleted = 0
                        this.itemToBeDeletedIndex = 0
                        this.confirmation = false
                    })
                
                
            }
        },
        computed: {
            formTitle () {
                return this.editedIndex === -1 ? 'Novo' : 'Editar'
            }
        },
        watch: {
            dialog (val) {
                val || this.close()
            },
            pagination: {
                handler () {
                    const { sortBy, descending, page, rowsPerPage } = this.pagination
                    this.getList(this.search,
                         sortBy,
                         page,
                         rowsPerPage,
                         this.pagination.descending)
                },
                deep: true
            }
        },
    }
</script>
<style scoped>
    #list
    {
        width: 100%;
    }
</style>
