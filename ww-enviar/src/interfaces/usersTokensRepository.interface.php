<?php

// Arquivo: userTokenRepository.php

interface IUsersTokensRepository {
    public function findOneByUserIdAndRefreshTokenWithUser($userId, $refreshToken): ?UserToken;
    public function create(ICreateUserTokenDTO $data): UserToken;
    public function delete($id): void;
}

// Arquivo: userToken.entity.php

class UserToken {
    // Defina os atributos e métodos necessários para a entidade UserToken
}

// Arquivo: userToken.dtos.php

interface ICreateUserTokenDTO {
    // Defina a estrutura do DTO ICreateUserTokenDTO conforme necessário
}

?>
