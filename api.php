<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    class Api{

        public $conn;

        public function __construct($dbServer = 'localhost', $dbName = 'compartilhando', $dbUserName = 'dev', $dbPassword = 'dev')
        {
            $this->conn = new PDO("mysql:host={$dbServer};dbname={$dbName}", $dbUserName, $dbPassword);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public function listaTarefas()
        {
            $sth = $this->conn->prepare("SELECT * FROM todos");
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
            $this->result(array('status' => 'success', 'message' => $result));
        }

        public function editarTarefa()
        {
            $sql = '';
            if(empty($_POST['todo'])){
                $mensagem = 'Tarefa invalida';
                $this->result(array('status' => 'error', 'message' => $mensagem));
            } else{
                $tarefa = json_decode($_POST['todo'], true);
                if(empty($tarefa['concluida'])){
                    $tarefa['concluida'] = 0;
                }
                if(empty($tarefa['descricao'])){
                    $this->result(array('status' => 'error', 'message' => 'Descricao inválida'));
                }
                elseif(!empty($tarefa['id'])){
                    // Atualiza tarefa
                    $sql = "update todos set descricao = '{$tarefa['descricao']}', concluida = {$tarefa['concluida']} where id = {$tarefa['id']}";
                    $data = $this->conn->query($sql);
                    $total = $data->rowCount();
                } else {
                    // Insere nova tarefa
                    $sql = "INSERT INTO todos(descricao, concluida) VALUES('{$tarefa['descricao']}', {$tarefa['concluida']})";
                    try{
                        $data = $this->conn->query($sql);
                        $total = $data->lastInserId();
                    }catch(Exception $e){
                        $total = $e->getMessage();
                    }

                }

                $this->result(array('status' => 'success', 'message' => $total, 'sql' => $sql));
            }
        }

        public function deletarTarefa(){
            if(empty($_POST['todo'])){
                $mensagem = 'Tarefa invalida';
                $this->result(array('status' => 'error', 'message' => $mensagem));
            } else{
                $tarefa = json_decode($_POST['todo'], true);
                $sql = "DELETE FROM todos where id = {$tarefa['id']}";
                $data = $this->conn->query($sql);
                $total = $data->rowCount();
                $this->result(array('status' => 'success', 'message' => 'Tarefa removida com sucesso', 'sql' => $sql));
            }
        }

        public function result($dados)
        {
            if(!empty($dados['status']) && $dados['status'] == 'error'){
                http_response_code(400);
            } else {
                http_response_code(200);
            }
            echo json_encode($dados);
            die();
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
            case 'deletarTarefa':
                $todosApi->deletarTarefa();
                break;
            default:
                $todosApi->result(array('status' => 'error', 'message' => 'Função não definida'));
                break;

        }
    } else {
        $todosApi->result(array('status' => 'error', 'message' => 'função não definida'));
    }



    
?>
