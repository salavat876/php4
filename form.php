<?php

function valid(array $post): array
{
    $validate = [
        'error' => false,
        'success' => false,
        'messages' => []
    ];

    if (!empty($post['login']) && !empty($post['password']) && !empty($post['firstName']) && !empty($post['lastName'])) {
        $login = trim($post['login']); //trim - очищает строку
        $password = trim($post['password']);
        $firstName = trim($post['password']);
        $lastName = trim($post['password']);

        $contrains = [
            'login' => 6,
            'password' => 7,
            'firstName' => preg_match("/^[а-яА-Я ]*$/", $firstName),
            'lastName' => preg_match("/^[а-яА-Я ]*$/", $lastName)
        ];

        $validateForm = valigData($login, $password, $firstName, $lastName, $contrains);

        if (!$validateForm['login']) {
            array_push($validate['messages'],
                "логин должен быть длиной не менее чем {$contrains['login']} символов и содержать русские буквы");
        }

        if (!$validateForm['password']) {
            array_push($validate['messages'],
                "пароль должен быть длиной не менее чем {$contrains['login']} символов");
        }

        if (!$validateForm['firstName']) {
            array_push($validate['messages'],
                "имя должно содержать только буквы и пробелы!");
        }

        if (!$validateForm['lastName']) {
            array_push($validate['messages'],
                "фамилия должна содержать только буквы и пробелы!");
        }
    }
    return $validate;
}

;


function valigData($login, $password, $firstName, $lastName, $contrains): array{
    $validateForm = [
        'login' => true,
        'password' => true,
        'firstName' => true,
        'lastName' => true
    ];

    if (strlen($validateForm['login']) < $contrains['login']) {
        $validateForm['login'] = false;
    }

    if (strlen($validateForm['password']) < $contrains['login']) {
        $validateForm['login'] = false;
    }

    if (!$validateForm['firstName']) {
        $validateForm['firstName'] = false;
    }

    if (!$validateForm['lastName']) {
        $validateForm['lastName'] = false;
    }

    return $validateForm;
}