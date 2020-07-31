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
            <div class="row">
                <div class="col">
                    <h3>Todos</h3>
                </div>
                <div class="col" style="margin-top: 40px;">
                    <a class="waves-effect waves-light btn-small teal" @click="listaTodos"><i class="material-icons left">list</i>Listar Todos</a>
                </div>
            </div>

            <div class="row"><div class="col" id="mensagem" v-html="mensagem"></div></div>

            <div class="row">
                <div class="col s6">
                    <input type="text" placeholder="Descrição" v-model="novoTodo.descricao">
                </div>
                <div class="col s1">
                    <label>
                        <input type="checkbox" class="filled-in" v-model="novoTodo.concluida" />
                        <span></span>
                    </label>
                </div>
                <div class="col s5">
                    <a class="waves-effect waves-light btn-small blue" @click="salvarTodo(novoTodo)"><i class="material-icons left">add_circle_outline</i>Adicionar</a>
                </div>
            </div>
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
                        <tbody>
                            <tr v-for="(todo, index) in todos" :key="index">
                                <td>{{todo.id}}</td>
                                <td><input type="text" v-model="todo.descricao" /></td>
                                <td>
                                    <label>
                                        <input type="checkbox" class="filled-in" v-model="todo.concluida"  true-value="1" false-value="0"/>
                                        <span></span>
                                    </label>
                                </td>
                                <td>
                                    <a class="waves-effect waves-light btn-small" @click="salvarTodo(todo)"><i class="material-icons left">save</i>Salvar</a>
                                    <a class="waves-effect waves-light btn-small red" @click="deletarTarefa(todo)"><i class="material-icons left">delete</i>Excluir</a>
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
                    novoTodo: [],
                    mensagem: ''
                },

                computed(){
                },

                mounted(){
                    console.log('carregou vuejs')
                    this.listaTodos();
                    this.limpaFormulario();
                },

                methods: {
                    listaTodos(){
                        axios.get('http://127.0.0.1/vuejscompartilhando/api.php?funcao=listar')
                        .then(response =>{
                            this.todos = response.data.message
                        })
                        .catch(response => {
                            console.log('Erro na listagem');
                        })
                    },

                    limpaFormulario(){
                        this.novoTodo = {
                            'id': '',
                            'descricao': '',
                            'concluida': ''
                        }
                    },

                    salvarTodo(todo){
                        this.limpaFormulario();
                        let formData = new FormData();
                        formData.append('funcao', 'editarTarefa');
                        formData.append('todo', JSON.stringify(todo));
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

                    deletarTarefa(todo){
                        let formData = new FormData();
                        formData.append('funcao', 'deletarTarefa');
                        formData.append('todo', JSON.stringify(todo));
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


    
    

