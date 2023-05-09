<?php

require __DIR__ . '/../core.php';

class Validation
{
    function validationTrigger($username, $useremail, $userpassword, $userConfirmedPassword)
    {
        if (!$this->isNameValid($username)) {
            $_SESSION['status'] = "error";
            $_SESSION['mensagem'] = "Nome inválido";

            return false;
        }

        if (!$this->isEmailValid($useremail)) {
            $_SESSION['status'] = "error";
            $_SESSION['mensagem'] = "E-mail inválido";

            return false;
        }

        if (!$this->isPasswordValid($userpassword)) {
            $_SESSION['status'] = "error";
            $_SESSION['mensagem'] = "Senha inválida";

            return false;
        }

        if (!$this->passwordAreEqual($userpassword, $userConfirmedPassword)) {
            $_SESSION['status'] = "error";
            $_SESSION['mensagem'] = "Senhas não são iguais";

            return false;
        }

        return true;
    }

    function isNameValid($name)
    {
        if (empty($name) || !preg_match("/^[A-Za-záàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ ]+$/", $name)) {
            return false;
        }
        return true;
    }

    function isEmailValid($email)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL) || !$this->thisEmailNotExist($email)) {
            return false;
        }
        return true;
    }

    function isPasswordValid($password)
    {
        if (empty($password) || !preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
            return false;
        }
        return true;
    }

    function thisEmailNotExist($email)
    {
        $userFile = file_get_contents($_ENV["REGISTER_FILENAME"]);
        $fileContentDecoded = json_decode($userFile);
        if (!$fileContentDecoded) {
            return true;
        }

        foreach ($fileContentDecoded as $user) {
            $otherEmailUsers = $user->usermail;
            if ($otherEmailUsers == $email) {
                return false;
            }
        }
        return true;
    }

    function validateMail($email)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['status'] = "error";
            $_SESSION['manesagem'] = "Email não encontrado";

            return false;
        }
        return true;
    }

    function passwordAreEqual($password, $confirmedpassword)
    {
        if ($password == $confirmedpassword) {
            return true;
        }
        return false;
    }

    function thisUserExist($email, $password)
    {
        $jsonbody = file_get_contents($_ENV["REGISTER_FILENAME"]);
        $filedecoded = json_decode($jsonbody);


        foreach ($filedecoded as $users) {
            $userEmailListed = $users->usermail;
            $userPassListed = $users->userpassword;
            if ($userEmailListed == $email && $userPassListed == $password) {
                $userObject = [
                    "username" => $users->name,
                    "email" => $email
                ];
                $_SESSION["userinfo"] = $userObject;

                return true;
            }
        }
    }
}
