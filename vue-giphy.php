<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>
            Vue.JS Giphy API In-Class Example</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
        <style media="screen">
            #giphy-results{
                display: block;
                width: 900px;
                padding: 3rem;
                margin: 0 auto;
            }
            .input{
                margin-bottom: 1rem;
            }
            button.input{
                text-align: center;
                justify-content: center;
            }
            p{
                padding: 1rem 0;
            }
            ul.columns{
                flex-wrap: wrap;
            }
            ul .is-full{
                display: block;
                width: 100%;
            }
            a{
                display: inline-block;
                transition: 0.3s ease all;
            }
            a:hover{
                transform: scale(1.1);
            }
        </style>
    </head>
    <body>
        <div id="giphy-search-container">
            <giphy-results></giphy-results>
        </div>
        <!-- Axios: -->
        <script type="text/javascript" src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <!-- Vue: -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <!-- Our Script(s) -->
        <script type="text/javascript" defer>

            // Giphy API Key
            var myGiphyAPIKey = 'reF7iIB74eJrRhbMelMlKaCeUxuo2R5N';

            //Giphy Search and Results Vue component
            Vue.component('giphy-results', {
                data: function (){
                    return{
                        apptitle: 'Vue.JS GIPHY API In-Class Example',
                        searchterm: '',
                        giphyResults:{},
                        isList: false
                    }
                },
                methods:{
                    giphySearch ()
                    {
                        axios.get('https://api.giphy.com/v1/gifs/search?api_key='+myGiphyAPIKey+'&q='+this.searchterm+'&limit=10')
                            .then( response => {
                                this.giphyResults = response.data.data;
                                // console.log( this.giphyResults);
                            } );
                    },
                    toggleListView(){
                        this.isList = !this.isList;
                    },
                    giphyImage(images){
                        if (this.isList === true) {
                            return images.original.url;
                        }
                        else{
                            return images.fixed_width.url;
                        }
                    }
                },
                template: `
                    <div id="giphy-results">
                        <h1 v-text="apptitle" class="title is-3"></h1>
                        <form @submit.prevent="giphySearch">
                            <input v-model="searchterm" type="search" class="input"
                                placeholder="Enter a Search Term.">
                            <input type="submit" value="Submit Search" class="input">
                            <button @click="toggleListView" class="input
                            has-text-centered">Toggle Grid/List View</button>
                        </form>
                        <p>Current Search Term: {{ searchterm }} </p>
                        <ul class="columns">
                            <li v-for="gif in giphyResults" class="column" v-bind:class="{
                                'is-full' : isList, 'is-one-quarter' : !isList }">
                                <a v-bind:href="gif.url" target="_blank">
                                    <img v-bind:src="giphyImage(gif.images)"
                                        v-bind:alt="gif.slug">
                                </a>
                            </li>
                        </ul>
                    </div>
                `
            });
            // Intiate Vue Instance for Search Container.
            var giphySearch = new Vue({
                el:'#giphy-search-container'
            });
        </script>

    </body>
</html>
