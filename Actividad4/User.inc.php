<?php

declare(strict_types=1);

class User
{
    private bool $logged = false;

    public function __construct(
        private string $username,
        private string $password,
        private string $mail
    ) {
    }

    public function __get(string $property): mixed
    {
        return match ($property) {
            'username' => $this->username,
            'password' => $this->password,
            'mail' => $this->mail,
            'logged' => $this->logged,
            default => throw new InvalidArgumentException(
                "Propiedad desconocida: $property"
            ),
        };
    }

    public function __set(string $property, mixed $value): void
    {
        match ($property) {
            'username' => $this->username = $value,
            'password' => $this->password = $value,
            'mail' => $this->mail = $value,
            'logged' => $this->logged = $value,
            default => throw new InvalidArgumentException(
                "Propiedad desconocida: $property"
            ),
        };
    }

    public function login(string $password): bool
    {
        if ($this->logged || $this->password !== $password) {
            return false;
        }

        $this->logged = true;
        return true;
    }

    public function logout(): void
    {
        $this->logged = false;
    }

    public function __toString(): string
    {
        return $this->username . ' (' . $this->mail . ')';
    }
}

function userExists(string $username, array $users): mixed
{
    foreach ($users as $user) {
        if ($user->username === $username) {
            return $user;
        }
    }

    return false;
}