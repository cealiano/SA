function logar(){


    var email = document.getElementById('email').value;
    var senha = document.getElementById('senha').value;


    if(email == "admin" && senha == "admin"){
        alert('Sucesso');
    }else{
        alert('Usuario ou senha incorreta')
    }
}