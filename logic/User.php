<?php

class User
{
    public int $id;
    public string $email;
    public string $password;

    public function __construct(int $id, string $email, string $password)
    {
        $this -> id = $id;
        $this -> email = $email;
        $this -> password = $password;
    }

    public function setId(int $id): void
    {
        $this -> id = $id;
    }

    public function getId(): int
    {
        return $this -> id;
    }

    public function __toString(): string
    {
        return $this -> email .": ". $this -> password;
    }
}
