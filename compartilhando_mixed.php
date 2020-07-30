<html>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <head>

        <!-- MATERIAL -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <!-- JQUERY -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <!-- VUE JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js" ></script>
        <script>Vue.config.devtools = true</script>
    </head>

    <body>
        <div id="app" class="container">
            <div class="col">
                <h3>{{tituloPagina}}</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Descrição</th>
                            <th>Finalizada</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Nome</td>
                            <td>Nome</td>
                            <td>Nome</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>


        <script>
            var app = new Vue({
                el: '#app',
                data: {
                    tituloPagina: ''
                },

                computed(){

                },

                created(){
                    this.tituloPagina = 'Lista de tarefas'
                }

            })

        </script>
    </body>
</html>


    
    

