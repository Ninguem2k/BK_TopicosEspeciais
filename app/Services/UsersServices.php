<?php

namespace App\Services;

use App\Repositories\UsersRepository;
use App\Providers\StorageProvider; // Certifique-se de substituir pelo provedor real.
use App\Exceptions\AppError;
use App\Utils\ValidationUtils;
use App\Utils\FormattingUtils;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersServices
{
    private $usersRepository;
    private $storageProvider;

    public function __construct(UsersRepository $usersRepository, StorageProvider $storageProvider)
    {
        $this->usersRepository = $usersRepository;
        $this->storageProvider = $storageProvider;
    }

    public function checkIfUserExists($id)
    {
        $user = $this->usersRepository->findOneById($id);

        if (!$user) {
            throw new AppError("User does not exist", 404);
        }

        return $user;
    }

    public function findOneById($id)
    {
        return UserMapper::toDTO($this->checkIfUserExists($id));
    }

    public function create($userDTO)
    {
        ValidationUtils::validateEmailFormat($userDTO['email']);
        ValidationUtils::validatePasswordFormat($userDTO['password']);
        ValidationUtils::validateCEPFormat($userDTO['cep']);
        ValidationUtils::validatePhoneFormat($userDTO['phone']);

        $userDTO['cep'] = FormattingUtils::formatCEP($userDTO['cep']);
        $userDTO['phone'] = FormattingUtils::formatPhone($userDTO['phone']);

        // Verificação do email é realizada posteriormente para evitar uma consulta desnecessária
        $userWithEmail = $this->usersRepository->findOneByEmail($userDTO['email']);
        if ($userWithEmail) {
            throw new AppError("This email is already related to another user", 400);
        }

        // Criptografando a senha antes de salvar
        $hashedPassword = Hash::make($userDTO['password'], ['rounds' => 10]);

        $this->usersRepository->create(array_merge($userDTO, ['password' => $hashedPassword]));
    }

    // Implemente os outros métodos de acordo com a lógica apresentada no código TypeScript

    // ...

}

?>
