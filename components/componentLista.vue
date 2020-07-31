<template>
  <div>
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

</template>


<script>
var app = new Vue({
  el: '#app',

  props: ['todos'],

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