
//Quando o botão para Entrar é apertado
function submitForm() {
    const mail = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const password2 = document.getElementById('password2').value;
    const emailPattern = /\S+@\S+\.\S+/;
    let mailTest = emailPattern.test(mail);
    const passPattern = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
    let passTest = passPattern.test(password);
    let passTest2 = passPattern.test(password2);

    if (mail == "" || mailTest == false) {
        return false
    }

    if (password == "" || passTest == false) {
        return false
    }

    if (password != password2 || passTest2 == false) {
        return false
    }
    
}

function changeTable(action) {
    let table1 = document.getElementById("table1").style;
    let table2 = document.getElementById("table2").style;

    if (action == "goAhead") {
        table1.display = 'none';
        table2.display = 'block';
    }

    if (action == "goBack") { 
        table1.display = 'block';
        table2.display = 'none';
    }
}

//Função para fazer a senha visivel
function showPass(inputID, buttonID, imgID) {
    let showPassword = document.getElementById(inputID);
    let ButtonId = document.getElementById(buttonID);
    let ImgID = document.getElementById(imgID);
    if (showPassword.type == 'password') {
        showPassword.type = 'text';
        ButtonId.removeChild(ButtonId.firstChild);
        ButtonId.innerHTML = "<img src='./assets/eye-focus.svg' class='eye' id='eye'></img>";
    } else {
        showPassword.type = 'password';
        ButtonId.removeChild(ButtonId.firstChild);
        ButtonId.innerHTML = "<img src='./assets/eye.svg' class='eye' id='eye'></img>";
    }
}

