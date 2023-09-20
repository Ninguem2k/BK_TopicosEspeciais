<?php
interface IStorageProvider {
  public function save(string $file, string $folder): string;
  public function delete(string $file, string $folder): void;
}
?>
