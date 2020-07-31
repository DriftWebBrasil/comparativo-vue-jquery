<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.11/vue.min.js" ></script>
    <script>Vue.config.devtools = true</script>
</head>

<body>

    <div id="app">
        <h1>{{mensagem}}</h1>
        <input type="text" v-model="mensagem">
        {{mensagem}}
    </div>

    <script>
        var app = new Vue({
            el: '#app',
            data: {
                mensagem: "Hello Drift",
            },
        })
    </script>

</body>
</html>