<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <!-- MATERIAL -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <!-- VUE JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js" ></script>
        <script>Vue.config.devtools = true</script>
        <!-- AXIOS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    </head>

    <body>
        <div id="app" class="container">
            <h3>Todos</h3>
            <div class="row">
                <div class="col">
                    <input type="text" v-model="novoTodo">
                </div>
                <div class="col">
                    <a class="waves-effect waves-light btn-small">Novo</a>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
                                <th>Concluida</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(todo, index) in todos">
                                <td>{{todo.id}}</td>
                                <td><input type="text" v-model="todo.descricao" /></td>
                                <td>
                                    <label>
                                        <input type="checkbox" class="filled-in" checked="checked" />
                                        <span></span>
                                    </label>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            var app = new Vue({
                el: '#app',
                
                data: {
                    todos: [],
                    novoTodo: ''
                },

                computed(){
                },

                mounted(){
                    console.log('carregou vuejs')
                    this.listaTodos();
                },

                methods: {
                    listaTodos(){
                        axios.get('http://127.0.0.1/vuejscompartilhando/api.php?funcao=listar')
                        .then(response =>{
                            this.todos = response.data
                        })
                    },

                    novoTodo(){

                    }
                }

            })

        </script>
    </body>
</html>


    
    

