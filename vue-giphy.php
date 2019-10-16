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
                        giphyResults:{}
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
                    }
                },
                template: `
                    <div id="giphy-results">
                        <h1 v-text="apptitle" class="title is-1"></h1>
                        <form @submit.prevent="giphySearch">
                            <input v-model="searchterm" type="search" class="input"
                                placeholder="Enter a Search Term">
                            <input type="submit" value="Submit Search" class="input">
                        </form>
                        <p>Current Search Term: {{ searchterm }} </p>
                        <ul v-for="gif in giphyResults" class="columns">
                            <li class="column">
                                <a v-bind:href="gif.url">
                                    <img v-bind:src="gif.images.fixed_width.url"
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
