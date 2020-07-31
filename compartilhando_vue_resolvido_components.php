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

            <cabecalho></cabecalho>

            <novo-todo :novoTodo="novoTodo"></novo-todo>

            <lista-todos :todos="todos"></lista-todos>

        </div>

        <script>
            var app = new Vue({
                el: '#app',
                
                data: {
                    todos: [],
                    novoTodo: [],
                    mensagem: ''
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


    
    

