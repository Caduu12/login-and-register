
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

function OpenAndCloseDivs(id1, id2, action, displayOfId = 'flex') {
    if (action == "open") {
        document.getElementById(id1).style.display = 'none';
        document.getElementById(id2).style.display = displayOfId;
    }

    if (action == "close") {
        document.getElementById(id1).style.display = displayOfId;
        document.getElementById(id2).style.display = 'none';
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

function modal(div) {
    
    if(document.getElementById(div).classList[1] == 'modal-close') {
        document.getElementById(div).classList.remove('modal-close');
        document.getElementById(div).classList.add('modal-open');
    } else {
        document.getElementById(div).classList.remove('modal-open');
        document.getElementById(div).classList.add('modal-close');
    }
    
}