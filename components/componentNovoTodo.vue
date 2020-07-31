<template>
  <div>
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
  </div>

</template>


<script>
var app = new Vue({
  el: '#app',

  prop: ['novoTodo'],

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