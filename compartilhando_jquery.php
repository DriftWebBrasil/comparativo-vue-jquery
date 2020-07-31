<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <!-- MATERIAL -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div id="app" class="container">

            <!--  TITULO E LISTAR-->
            <div class="row">
                <div class="col">
                    <h3>Todos</h3>
                </div>
                <div class="col" style="margin-top: 40px;">
                    <a class="waves-effect waves-light btn-small teal" id="bota-listar-todos"><i class="material-icons left">list</i>Listar Todos</a>
                </div>
            </div>

            <div class="row"><div class="col" id="mensagem"></div></div>

            <!--  NOVA TAREFA  -->
            <div class="row">
                <div class="col s6">
                    <input type="text" placeholder="Descrição" id="novo-todo-descricao">
                </div>
                <div class="col s1">
                    <label>
                        <input type="checkbox" class="filled-in" id="novo-todo-concluido"/>
                        <span></span>
                    </label>
                </div>
                <div class="col s5">
                    <a class="waves-effect waves-light btn-small blue" id="botao-adicionar-todo"><i class="material-icons left">add_circle_outline</i>Adicionar</a>
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
                        <tbody id="lista-todos">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            $(function(){
                listarTodos();

                $('#botao-adicionar-todo').click(function(){
                    todo = {
                        descricao: $("#novo-todo-descricao").val(),
                        concluida: $("#novo-todo-concluido").val()
                    }
                    novoTodo(todo);
                    console.log(todo);
                })

                var listaTodos = [];

                var todo = {
                    id: '',
                    descricao: '',
                    concluido: ''
                }
                console.log('carregou Jquery');

                function listarTodos(){
                    $.ajax({
                        url : "http://127.0.0.1/vuejscompartilhando/api.php?funcao=listar",
                        type : 'get',
                        data : {
                        }
                        })
                        .done(function(msg){
                            renderizaTodos(msg);
                        })
                        .fail(function(jqXHR, textStatus, msg){
                            alert(msg);
                        });
                }

                function novoTodo(todo){
                    $.ajax({
                        url : "http://127.0.0.1/vuejscompartilhando/api.php?funcao=editarTarefa",
                        type : 'post',
                        data : {
                            funcao: 'editarTarefa',
                            todo: todo
                        },
                        beforeSend : function(){
                        }
                        })
                        .done(function(msg){
                            console.log(msg);
                        })
                        .fail(function(jqXHR, textStatus, msg){
                            alert(msg);
                        });

                }

                function alterarTodo(){
                    $.ajax({
                        url : "http://127.0.0.1/vuejscompartilhando/api.php?funcao=editarTarefa",
                        type : 'post',
                        data : {
                            funcao: 'editarTarefa',
                            todo: todo
                        },
                        beforeSend : function(){
                        }
                    })
                        .done(function(msg){
                            console.log(msg);
                        })
                        .fail(function(jqXHR, textStatus, msg){
                            alert(msg);
                        });
                }

                function renderizaTodos(todos){
                    console.log('renderiza todos');
                    listaTodos = JSON.parse(todos);
                    html = '';
                    $.each(listaTodos.message, function(index, value) {
                        console.log(value);
                        html += "<tr>";
                        html += '<td>' + value.id + '</td>';
                        html += '<td><input type="text" value="' + value.descricao + '"/></td></td>';
                        html += '<td><label><input type="checkbox" class="filled-in" value="' + value.concluida + '"/><span></span></label></td>';
                        html += "</tr>";
                    });

                    $("#lista-todos").append(html);
                }

            });
        </script>
    </body>
</html>


    
    

