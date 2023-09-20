<?php

namespace App\Repositories;

use App\Models\UserToken;

class UserTokenRepository
{
    public function findByUserIdAndRefreshTokenWithUser(string $userId, string $refreshToken): ?UserToken
    {
        return UserToken::where('user_id', $userId)
            ->where('refresh_token', $refreshToken)
            ->with('user')
            ->first();
    }

    public function create(array $data): UserToken
    {
        return UserToken::create($data);
    }

    public function delete(string $id): void
    {
        UserToken::destroy($id);
    }
}
