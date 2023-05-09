<?php

require __DIR__ . '/../core.php';

class FileManagement
{

    function checkIfFileExist()
    {
        if (file_exists($_ENV["REGISTER_FILENAME"])) {
            return true;
        } else {
            return false;
        }
    }

    function isFileArray()
    {
        $fileContent = file_get_contents($_ENV["REGISTER_FILENAME"]);

        $fileDecoded = json_decode($fileContent);

        if (!is_array($fileDecoded)) {
            header("Location: register.php");
        }
    }

    function createFileIfDontExist()
    {
        if (!file_exists($_ENV["REGISTER_FILENAME"])) {
            $createFile = fopen($_ENV["REGISTER_FILENAME"], "w");
            fclose($createFile);
            return true;
        }
    }

    function createUserInFile($username, $useremail, $userpassword)
    {
        $baseJsonFile = file_get_contents($_ENV["REGISTER_FILENAME"]);

        $decodedObject = json_decode($baseJsonFile) ?? [];

        $newUserObject = [
            "name" => $username,
            "usermail" => $useremail,
            "userpassword" => $userpassword
        ];

        array_push($decodedObject, $newUserObject);

        $encodeToJson = json_encode($decodedObject);

        $editingFile = fopen($_ENV["REGISTER_FILENAME"], "w");
        fwrite($editingFile, $encodeToJson);

        fclose($editingFile);
    }
}
