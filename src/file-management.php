<?php

class FileManagement
{
    function checkIfFileExist()
    {
        if (file_exists("usersRegister")) {
            return true;
        } else {
            return false;
        }
    }
    
    function isFileArray() 
    {
        $fileContent = file_get_contents("users");

        if (!is_array($fileContent)) {
            header("Location: register.php");
        }

        
    }

    function createFileIfDontExist()
    {
        if (file_exists("usersRegister.json")) {
            $createFile = fopen("userRegister.json", "w");
            fclose($createFile);
            return true;
        }
    }

    function createUserInFile($username, $useremail, $userpassword)
    {
        $baseJsonFile = file_get_contents("usersRegister.json");

        $decodedObject = json_decode($baseJsonFile) ?? [];

        $newUserObject = [
            "name" => $username,
            "usermail" => $useremail,
            "userpassword" => $userpassword
        ];

        array_push($decodedObject, $newUserObject);

        $encodeToJson = json_encode($decodedObject);

        $editingFile = fopen("usersRegister.json", "w");
        fwrite($editingFile, $encodeToJson);

        fclose($editingFile);
    }
}
