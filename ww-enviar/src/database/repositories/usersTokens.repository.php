<?php
// Importações não são necessárias em PHP como no TypeScript

// Ajuste das importações
// import { ICreateUserTokenDTO } from "../../dtos/userToken.dtos";
// import { IUsersTokensRepository } from "../../interfaces/usersTokensRepository.interface";
// import { appDataSource } from "..";
// import { UserToken } from "../entities/userToken.entity";

// Supomos que as classes ICreateUserTokenDTO, IUsersTokensRepository,
// appDataSource e UserToken já foram definidas em PHP

class UsersTokensRepository implements IUsersTokensRepository {
    private $repository;

    public function __construct() {
        // Supomos que appDataSource::getRepository é um método estático
        $this->repository = appDataSource::getRepository(UserToken::class);
    }

    public function findOneByUserIdAndRefreshTokenWithUser($userId, $refreshToken) {
        // Supomos que findOne é um método na classe de repositório em PHP
        return $this->repository->findOneBy(['user_id' => $userId, 'refresh_token' => $refreshToken]);
    }

    public function create(ICreateUserTokenDTO $userTokenDTO) {
        // Supomos que create é um método na classe de repositório em PHP
        $userToken = $this->repository->create($userTokenDTO);
        return $this->repository->save($userToken);
    }

    public function delete($id) {
        // Supomos que delete é um método na classe de repositório em PHP
        return $this->repository->delete($id);
    }
}
?>
