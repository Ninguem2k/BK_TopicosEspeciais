<?php
// Import das classes e interfaces necessárias
require_once 'typeorm.php';
require_once '../../interfaces/usersRepository.interface.php';
require_once '../../dtos/user.dtos.php';
require_once '../appDataSource.php';
require_once 'user.entity.php';

class UsersRepository implements IUsersRepository {
  private $repository;

  public function __construct() {
    $this->repository = AppDataSource::getRepository(User::class);
  }

  public function findOneById($id) {
    return $this->repository->findOneBy(array('id' => $id));
  }

  public function findOneByEmail($email) {
    return $this->repository->findOneBy(array('email' => $email));
  }

  public function create($userDTO) {
    $user = $this->repository->create($userDTO);
    $this->repository->save($user);
  }

  public function update($user, $userDTO) {
    // Merge as propriedades do usuário com os dados do DTO
    $mergedUser = array_merge($user, $userDTO);

    // Salva o usuário atualizado
    $this->repository->save($mergedUser);
  }

  public function delete($id) {
    $this->repository->delete($id);
  }
}
?>
