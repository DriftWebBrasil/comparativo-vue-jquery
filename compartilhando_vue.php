<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <!-- MATERIAL -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- VUE JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js" ></script>
        <script>Vue.config.devtools = true</script>
        <!-- AXIOS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    </head>

    <body>
        <div id="app" class="container">

            <!--  TITULO E LISTAR-->
            <div class="row">
                <div class="col">
                    <h3>Todos</h3>
                </div>
                <div class="col" style="margin-top: 40px;">
                    <a class="waves-effect waves-light btn-small teal" @click="listarTodos"><i class="material-icons left">list</i>Listar Todos</a>
                </div>
            </div>

            <div class="row"><div class="col" id="mensagem"></div></div>

            <!--  NOVA TAREFA  -->
            <div class="row">
                <div class="col s6">
                    <input type="text" placeholder="Descrição">
                </div>
                <div class="col s1">
                    <label>
                        <input type="checkbox" class="filled-in" />
                        <span></span>
                    </label>
                </div>
                <div class="col s5">
                    <a class="waves-effect waves-light btn-small blue"><i class="material-icons left">add_circle_outline</i>Adicionar</a>
                </div>
            </div>

            <!-- LISTA TAREFAS -->
            <div class="row">
                <div class="col s12">
                    <table class="striped centered responsive">
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Descrição</th>
                                <th>Concluida</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>.-
                            <tr v-if="todos" v-for="(index, todo) in todos" :key="index">
                                <td>{{todo.id}}</td>
                                <td><input type="text" v-model="todo.descricao"/></td>
                                <td>
                                    <label>
                                        <input type="checkbox" class="filled-in" v-model="todo.concluida" true-value="1" false-value="0"/>
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <a class="waves-effect waves-light btn-small"><i class="material-icons left">save</i>Salvar</a>
                                    <a class="waves-effect waves-light btn-small red"><i class="material-icons left">delete</i>Excluir</a>
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
                    novoTodo: [

                    ],
                    todos: []
                },

                mounted(){
                    console.log('carregou vuejs')
                },

                methods: {
                    novoTodo(){

                    },

                    listarTodos(){
                        axios.get('http://127.0.0.1/vuejscompartilhando/api.php?funcao=listar')
                            .then(response =>{
                                this.todos = response.data.message
                            })
                            .catch(response => {
                                console.log('Erro na listagem');
                            })
                    },

                    editar(){
                        axios.post('http://127.0.0.1/vuejscompartilhando/api.php?funcao=editar', formData)
                            .then(response =>{
                                this.todos = response.data.mensagem
                            })
                            .catch(error =>{
                                console.log('error');
                                console.log(error.response);
                                this.mensagem = error.response.data.message;
                            }).finally(response => this.listaTodos())
                    },

                    deletarTodo(){
                        axios.post('http://127.0.0.1/vuejscompartilhando/api.php?funcao=deletarTarefa', formData)
                            .then(response =>{
                                this.todos = response.data.mensagem
                            })
                            .catch(error =>{
                                console.log('error');
                                console.log(error.response);
                                this.mensagem = error.response.data.message;
                            }).finally(response => this.listaTodos())
                    }

                }

            })

        </script>
    </body>
</html>


    
    

