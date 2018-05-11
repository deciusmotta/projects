<template>
    <crud 
        name="Projetos" 
        :headers="headers" 
        endPoint='/project' 
        newItemText="Novo Projeto"
        :fields="fields"
        :editedItemProp="editedItem"
        :defaultItemProp="defaultItem"
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
                    { text: 'Ações', value: '', sortable: false},
                ],
                fields: [
                    {name: 'id', label: 'Id', type: 'Number', showInTable: true}, 
                    {name: 'name', label: 'Nome', type: 'String', showInTable: true, required: true},
                    {name: 'description', label: 'Descrição', type: 'TextArea', showInTable: false, required: true},
                ],
                editedItem: {
                    name: '',
                    description: ''
                },
                defaultItem: {
                    name: '',
                    description: ''
                }
            }
        },
        components: {
            Crud
        }

    }


</script>
