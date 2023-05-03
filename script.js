
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
        errorConfig('error122', 'Por favor, coloque um email válido');
        return false
    } else {
        document.getElementById('error122').style.display = 'none';
    }

    if (password == "" || passTest == false) {
        errorConfig('error122', 'Por favor, coloque uma senha válida');
        return false
    } else {
        document.getElementById('error122').style.display = 'none';
    }

    if (password != password2 || passTest2 == false) {
        errorConfig('error122', 'Coloque senhas iguais');
        return false
    } else {
        document.getElementById('error122').style.display = 'none';
    }
    
}

function errorConfig(idOfInput, message) {
    document.getElementById(idOfInput).style.display = 'block';
    document.getElementById(idOfInput).innerText = message;
}

//Função para fazer a senha visivel
function showPass(inputID, buttonID, imgID) {
    let showPassword = document.getElementById(inputID);
    let ButtonId = document.getElementById(buttonID);
    let ImgID = document.getElementById(imgID);
    if (showPassword.type == 'password') {
        showPassword.type = 'text';
        ButtonId.removeChild(ButtonId.firstChild);
        ButtonId.innerHTML = "<img src='./assets/eyeFocus.svg' class='eye' id='eye'></img>";
    } else {
        showPassword.type = 'password';
        ButtonId.removeChild(ButtonId.firstChild);
        ButtonId.innerHTML = "<img src='./assets/eye.svg' class='eye' id='eye'></img>";
    }
}

