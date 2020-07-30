<?php
    class Api{

        public $conn;

        public function __contruct($dbServer = 'localhost', $dbName = 'compartilhando', $dbUserName = 'root', $dbPassword = 'root')
        {
            $this->conn = new PDO("mysql:host={$dbServer};dbname={$dbName}", $dbUserName, $dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function listaTarefas()
        {
            $data = $this->conn->query("SELECT * FROM todos");
            $resultado = $data->fetchAll();
            $this->result($resultado);
        }

        public function editarTarefa()
        {
            if(!isset($_GET['tarefa'])){
                $mensagem = 'Tarefa invalida';
            } else {
                $tarefa = json_decode($_GET['tarefa']);
                if(isset($tarefa['id'])){
                    // Atualiza tarefa
                    $sql = "update tarefas set descricao = {$tarefa['descricao']}, concluida = {$tarefa['concluida']} where id = {$tarefa['id']}";
                    $data = $this->conn->query($sql);
                    $total = $data->rowCount();
                } else {
                    // Insere nova tarefa
                }
            }
        }

        public function result($dados)
        {
            echo json_encode($dados);
        }

    }

    $todosApi = new Api();

    if(isset($_GET['funcao'])){
        switch($_GET['funcao']){
            case 'listar':
                $todosApi->listaTarefas();
                break;
            case 'editar':
                $todosApi->editarTarefa();
                break;
        }
    } else {
        $todosApi->result(array('status' => 'error', 'mensagem' => 'função não definida'));
    }



    
?>
