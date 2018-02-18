<template>
  <crud 
    name="Usuários" 
    :headers="headers" 
    endPoint='/user' 
    newItemText="Novo Usuário"
    :fields="fields"
    :editedItem="editedItem"
    :defaultItem="defaultItem"
    >
    </crud>
</template>

<script>
    import Crud from '../Crud/Crud.vue'

    export default {
        data () {
            return {
                headers: [
                    { text: 'Id', value: 'id' },                    
                    { text: 'Nome', value: 'name'},
                    { text: 'E-mail', value: 'email'},
                    { text: 'Ações', value: '', sortable: false},
                ],
                fields: [
                    {name: 'id', label: 'Id', type: 'Number', showInTable: true}, 
                    {name: 'name', label: 'Nome', type: 'String', showInTable: true},
                    {name: 'email', label: 'E-mail', type: 'String', showInTable: true},
                    {name: 'password', label: 'Senha', type: 'String', showInTable: false},
                ],
                editedItem: {
                    name: '',
                    email: '',
                    password: '',
                },
                defaultItem: {
                    name: '',
                    email: '',
                    password: '',
                }
            }
        },
        components: {
            Crud
        }

    }


</script>
