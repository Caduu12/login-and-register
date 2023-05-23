<?php

require __DIR__ . '/../core.php';

class Validation
{
    function registerValidationTrigger($username, $useremail, $userpassword, $userConfirmedPassword)
    {
        if (!$this->isNameValid($username)) {
            $errorMessage = "Nome inválido";
            setSessionFlashError($errorMessage);
            return false;
        }

        if (!$this->isEmailValid($useremail)) {
            $errorMessage = "Email inválido";
            setSessionFlashError($errorMessage);
            return false;
        }

        if (!$this->isPasswordValid($userpassword)) {
            $errorMessage = "Senha inválida";
            setSessionFlashError($errorMessage);
            return false;
        }

        if (!$this->passwordAreEqual($userpassword, $userConfirmedPassword)) {
            $errorMessage = "Senhas não são iguais";
            setSessionFlashError($errorMessage);
            return false;
        }

        return true;
    }

    function logInValidationTrigger($userEmail, $userPassword)
    {
        if (!$this->validateMail($userEmail)) {
            $errorMessage = "E-mail inválido";
            setSessionFlashError($errorMessage);
            return false;
        }

        if (!$this->isPasswordValid($userPassword)) {
            $errorMessage = "Senha inválida";
            setSessionFlashError($errorMessage);
            return false;
        }

        if (!$this->thisUserExist($userEmail, $userPassword)) {
            $errorMessage = "Email ou Senha incorretos";
            setSessionFlashError($errorMessage);
            return false;
        }

        $_SESSION["flag"] = true;
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
            if (strcasecmp($email, $otherEmailUsers) == 0) {
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
            if (strcasecmp($email, $userEmailListed) == 0 && $userPassListed == $password) {
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
