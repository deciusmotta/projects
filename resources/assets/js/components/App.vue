<template>
    <div id="app" class="container-fluid">        
        <v-app id="inspire">                        
            <v-navigation-drawer
            fixed
            v-model="drawer"
            app
            >
            <v-list dense>
                <v-list-tile @click="">
                <v-list-tile-action>
                    <v-icon>work</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>                                    
                    <v-list-tile-title>
                        <router-link :to="{path: '/projects'}">
                            Projetos
                        </router-link>
                    </v-list-tile-title>                    
                </v-list-tile-content>
                </v-list-tile>
                <v-list-tile @click="">
                <v-list-tile-action>
                    <v-icon>contact_mail</v-icon>
                </v-list-tile-action>
                <v-list-tile-content>
                    <v-list-tile-title>
                        <router-link :to="{path: '/users'}">
                            Usuários
                        </router-link>
                    </v-list-tile-title>
                </v-list-tile-content>
                </v-list-tile>
            </v-list>
            </v-navigation-drawer>
            <v-toolbar color="indigo" dark fixed app>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Application</v-toolbar-title>
            </v-toolbar>
            <v-content>
            <v-container fluid fill-height>
                <v-layout
                justify-center
                align-center
                >
                <v-flex xs12>
                    <router-view/>
                </v-flex>
                </v-layout>                
            </v-container>
            </v-content>
            <v-footer color="indigo" app>
                <span class="white--text">&copy; 2017</span>
            </v-footer>
        
        </v-app>
    </div>

</template>

<script>
    export default {
        name: "app",
        data: () => ({
            drawer: null
        }),
        props: {
            source: String
        }
    }
</script>
