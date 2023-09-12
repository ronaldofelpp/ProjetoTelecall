


jQuery.validator.setDefaults({
    
    success: "valid"
  });
$("#form").validate({
    normalizer: function( value ) {
        return $.trim( value );
    },
    
    rules:{
        
        login:{
            required: true,
        },
        senha:{
            required: true,
        },
    },
    messages: {
        login:{
            required: "*Informe seu Login",
        },

        senha: {
            required: "*Informe sua senha",
        },


    },
    submitHandler: function (form)  {

        var login = $("#login").val();
        var senha = $("#senha").val();

        var listaUser = JSON.parse(localStorage.getItem("listaUser"));

        var usuarioValido = listaUser.find(function(usuario){
            return usuario.loginCad === login && usuario.senhaCad === senha;
        })
        
        if (usuarioValido){
            //form.submit();
            
            window.location.href = "tela3.html";
            
        }
        else {
            $("#loginForm-error").html('<span class="error" style="display: flex; margin-top: 10px;margin-bottom: -20px;">*Usuário ou senha incorretos.</span>');

        }
            
        
        
    }
});


/*function entrar(){
    let loginInput = document.querySelector("#login");
    let senhaInput = document.querySelector("#senha");

    let listaUser = []
    let userValid = {
        login: '',
        senha: '',
    }
            
    listaUser = JSON.parse(localStorage.getItem('listaUser'))

    listaUser.forEach((item) => {
        if(loginInput.value == item.loginCad && senhaInput.value == item.senhaCad){

            userValid = {
                login: item.loginCad,
                senha: item.senhaCad
            }
    }
    console.log(userValid)
    })
}

function entrar(){
    let loginInput = document.querySelector("#login");
    let loginLabel = dpcument.querySelector("#loginLabel");

    let senhaInput = document.querySelector("#senha");
    let senhaLabel = dpcument.querySelector("#senhaLabel");

    let msgError = document.querySelector("#msgError")
    let listaUser = []

    let userValid = {
        nome: '',
        login: '',
        senha: '',
    }
            
    listaUser = JSON.parse(localStorage.getItem('listaUser'))

    listaUser.forEach((item) => {
        if(loginInput.value == item.loginCad && senhaInput.value == item.senhaCad){

            userValid = {
                nome: item.nomeCad,
                login: item.loginCad,
                senha: item.senhaCad
            }
    }
    
    })
    console.log(userValid)
}*/

