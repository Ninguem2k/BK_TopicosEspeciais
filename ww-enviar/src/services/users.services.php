<?php
namespace App\Services;

use App\Interfaces\IUsersRepository;
use App\Interfaces\IStorageProvider;
use App\DTOs\ICreateUserRequestDTO;
use App\DTOs\IResponseUserDTO;
use App\DTOs\IUpdateUserDTO;
use App\DTOs\IUpdateUserRequestDTO;
use App\Errors\AppError;
use App\Utils\Validation\validateEmailFormat;
use App\Utils\Validation\validatePasswordFormat;
use App\Utils\Validation\validateCEPFormat;
use App\Utils\Validation\validatePhoneFormat;
use App\Utils\Formatting\formatCEP;
use App\Utils\Formatting\formatPhone;
use App\Entities\User;
use App\Mappers\UserMapper;
use Illuminate\Support\Facades\Hash;

class UsersServices
{
    private $usersRepository;
    private $storageProvider;

    public function __construct(
        IUsersRepository $usersRepository,
        IStorageProvider $storageProvider
    ) {
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

    public function create(ICreateUserRequestDTO $userDTO)
    {
        validateEmailFormat($userDTO->email);
        validatePasswordFormat($userDTO->password);
        validateCEPFormat($userDTO->cep);
        validatePhoneFormat($userDTO->phone);

        $userDTO->cep = formatCEP($userDTO->cep);
        $userDTO->phone = formatPhone($userDTO->phone);

        // Verificação do email é realizada posteriormente para evitar uma consulta desnecessária
        $userWithEmail = $this->usersRepository->findOneByEmail($userDTO->email);
        if ($userWithEmail) {
            throw new AppError("This email is already related to another user", 400);
        }

        // Criptografando a senha antes de salvar
        $hashedPassword = Hash::make($userDTO->password);

        $this->usersRepository->create((array)$userDTO, $hashedPassword);
    }

    // Restante do código segue o mesmo padrão de tradução

    // ...

    public function deleteAvatar($id)
    {
        $user = $this->checkIfUserExists($id);

        if (!$user->avatar_url || !$user->avatar) {
            throw new AppError("Image does not exist", 404);
        }

        $this->storageProvider->delete($user->avatar, "avatar");

        // Excluindo a URL e o caminho do arquivo
        $user->avatar = null;
        $user->avatar_url = null;

        $this->usersRepository->update($user, (array)$user);
    }
}

?>
