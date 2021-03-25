<?php

function valid(array $post): array
{
    $validate = [
        'error' => false,
        'success' => false,
        'messages' => [],
    ];



    if (!empty($post['login']) && !empty($post['password']) && !empty($post['firstName']) && !empty($post['lastName'])) {
        $login = trim($post['login']); //trim - очищает строку
        $password = trim($post['password']);
        $firstName = trim($post['password']);
        $lastName = trim($post['password']);

        $constrains = [
            'login' => 6,
            'password' => 7,
            'firstName' => preg_match("/^[а-яА-Я ]*$/", $firstName),
            'lastName' => preg_match("/^[а-яА-Я ]*$/", $lastName)
        ];


        $validateForm = valigData($login, $password, $firstName, $lastName, $constrains);

        if (!$validateForm['login']) {
            array_push($validate['messages'],
                "логин должен быть длиной не менее чем {$constrains['login']} символов");
        }

        if (!$validateForm['password']) {
            array_push($validate['messages'],
                "пароль должен быть длиной не менее чем {$constrains['password']} символов");
        }

        if (!$validateForm['firstName']) {
            array_push($validate['messages'],
                "имя должно содержать только буквы и пробелы!");
        }

        if (!$validateForm['lastName']) {
            array_push($validate['messages'],
                "фамилия должна содержать только буквы и пробелы!");
        }
        if (!$validate['error']){
            $validate['success'] = true;
            array_push($validate['messages'],"Ваш логин:{$login}",
                "Ваш пароль:{$password}",
                "Ваше имя:{$firstName}",
                "Ваша фамилия:{$lastName}"
            );
        }
    }
    return $validate;

}


function valigData(string $login, string $password,string $firstName,string $lastName,array $constrains): array{

    $validateForm = [
        'login' => true,
        'password' => true,
        'firstName' => preg_match('/[^а-яА-Я\s]+/msi', $firstName),
        'lastName' => preg_match('/[^а-яА-Я\s]+/msi', $lastName)
    ];

    if (strlen($login) < $constrains['login']) {
        $validateForm['login'] = false;
    }

    if (strlen($password) < $constrains['password']) {
        $validateForm['password'] = false;
    }

    if (!$firstName) {
        $validateForm['firstName'] = false;
    }

    if (!$lastName) {
        $validateForm['lastName'] = false;
    }

    return $validateForm;

}
