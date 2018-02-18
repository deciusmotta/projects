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

            <v-layout row v-for="field in fields" :key="field.name">
              <v-flex xs12 sm12 md12 v-if="field.type == 'String'">
                <v-text-field box :required="field.required" :label="field.label" v-model="editedItem[field.name]"></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12 v-if="field.type == 'TextArea'">
                <v-text-field box :required="field.required" :label="field.label" v-model="editedItem[field.name]" textarea></v-text-field>
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
        {{name}}
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
            no-data-text="Nenhum registro"
        >
        <template slot="items" slot-scope="props">
            <!-- <td>{{ props.item.id }}</td>
            <td>{{ props.item.name }}</td> -->
            <td v-for="field in tableFields">
              {{ props.item[field.name] }}
            </td>
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
            Sua pesquisa por "{{ search }}" trouxe nenhum resultado.
        </v-alert>
        </v-data-table>
    </v-card>
    <v-layout row justify-center>        
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
                dialog: false                
            }
        },
        props: {
          name: {
            type: String
          },
          newItemText: {
            type: String
          },
          headers: {
            type: Array
          },
          endPoint: {
            type: String
          },
          fields: {
            type: Array
          },
          editedItem: {
            type: Object
          },
          defaultItem: {
            type: Object
          }
        },
        mounted() {
            
        },
        methods: {
            getList(search, sortBy, page, rowsPerPage, descending) {
                if(this.pagination.sortBy != undefined){
                    this.$http.get(this.endPoint, {
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
                    this.createItem(this.editedItem)
                }
                this.close()
            },
            createItem (newItem) {
                console.log(newItem)
                this.$http.post(this.endPoint, newItem).then( data => {
                        console.log(data)
                        this.items.push(data.data)
                        this.color = 'success'
                        this.message = "Item salvo com sucesso"
                        this.snackbar = true
                    })
                
            },
            updateItem (updatedItem) {
                this.$http.put(this.endPoint + '/' + updatedItem.id, updatedItem).then( data => {
                        console.log(data)
                    const { sortBy, descending, page, rowsPerPage } = this.pagination
                    this.getList(this.search,
                        sortBy,
                        page,
                        rowsPerPage,
                        this.pagination.descending)
                        this.color = 'success'
                        this.message = "Item atualizado com sucesso"
                        this.snackbar = true
                    })
            },
            destroyItem () {
                this.$http.delete(this.endPoint + this.itemToBeDeleted).then( data => {
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
            },
            tableFields () {
              return this.fields.filter(function (field){
                return field.showInTable == true;
              });
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
