<?php

namespace Classes;

use DateTime;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Positive;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\Email;


class User
{
    private int $id;
    private string $username;
    private string $email;
    private string $passwordHash;
    private DateTime $registerDate;

    public function __construct(int $id, string $username, string $email, string $password)
    {
        $this->id=$this->checkId($id);
        $this->username=$this->checkUsername($username);
        $this->email=$this->checkEmail($email);
        $this->passwordHash=$this->checkPassword($password);
        $this->registerDate=new DateTime();
    }  

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }
    
    public function getPasswordHash()
    {
        return $this->passwordHash;
    }

    public function getRegisterDate()
    {
        return $this->registerDate;
    }

    public function checkId(int $id)
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($id, [
            new NotBlank(),
            new Positive(),
        ]);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                echo "'$id' is invalid value for id<br>"; 
                echo $violation->getMessage().'<br><br>';
                return -1;
            }
        }

        return $id;
    }

    public function checkUsername(string $username)
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($username, [
            new NotBlank(),
            new Length(['min' => 5]),
            new Length(['max' => 20]),
        ]);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                echo "'$username' is invalid value for username<br>";
                echo $violation->getMessage().'<br><br>'; 
                return 'default_value';
            }
        }

        return $username;
    }

    public function checkEmail(string $email)
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($email, [
            new NotBlank(),
            new Length(['min' => 5]),
            new Length(['max' => 35]),
            new Email(message: '{{ value }} is invalid email',),
        ]);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                echo "'$email' is invalid value for email<br>"; 
                echo $violation->getMessage().'<br><br>';
                return 'default_value';
            }
        }

        return $email;
    }

    public function checkPassword(string $password)
    {
        $validator = Validation::createValidator();
        $violations = $validator->validate($password, [
            new NotBlank(),
            new Length(['min' => 8]),
            new Length(['max' => 20]),
        ]);

        if (0 !== count($violations)) {
            foreach ($violations as $violation) {
                echo "'$password' is invalid value for password<br>"; 
                echo $violation->getMessage().'<br><br>';
                return 'default_value';
            }
        }

        return password_hash($password, PASSWORD_DEFAULT, ['salt' => 'ParamPaparam']);
    }

    public function showInfo()
    {
        echo "<dl>
                <h3>User - " . $this->username . "</h3>
                <dd>id - " . $this->id . "</dd>
                <dd>username - " . $this->username . "</dd>
                <dd>email - " . $this->email . "</dd>
                <dd>password hash - " . $this->passwordHash . "</dd>
                <dd>register date - " . $this->registerDate->format('d M Y') . "</dd>
            </dl>";
    }    
}
