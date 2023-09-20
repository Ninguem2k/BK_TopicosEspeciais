<?php
// LocalStorageProvider.php

class LocalStorageProvider implements IStorageProvider {
  public function save($file, $folder) {
    $sourcePath = resolve($tmpFilePath, $file);
    $destinationPath = resolve($tmpFilePath, $folder, $file);

    // Método rename irá trocar o caminho do arquivo
    rename($sourcePath, $destinationPath);

    return $file;
  }

  public function delete($file, $folder) {
    $filename = resolve($tmpFilePath, $folder, $file);

    // Verifica se o arquivo existe antes de tentar excluir
    if (file_exists($filename)) {
      unlink($filename); // Exclui o arquivo
    }
  }
}
?>
