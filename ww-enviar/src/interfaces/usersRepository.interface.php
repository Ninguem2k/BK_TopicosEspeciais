<?php
// Arquivo: UserRepositoryInterface.php

interface IUserRepository {
    public function findOneById(string $id): ?User;
    public function findOneByEmail(string $email): ?User;
    public function create(ICreateUserDTO $userDTO): void;
    public function update(User $user, IUpdateUserDTO $userDTO): void;
    public function delete(string $id): void;
}
