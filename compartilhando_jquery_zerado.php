<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>
        <!-- MATERIAL -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
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
                    <a class="waves-effect waves-light btn-small teal"><i class="material-icons left">list</i>Listar Todos</a>
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
                        <tbody>
                        <tr>
                            <td></td>
                            <td><input type="text"/></td>
                            <td>
                                <label>
                                    <input type="checkbox" class="filled-in"/>
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
            $(function(){
                console.log('carregou Jquery');
            });
        </script>
    </body>
</html>


    
    

