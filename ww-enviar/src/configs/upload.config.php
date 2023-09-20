<?php
// Configuração para o Multer
function createMulterConfig() {
    global $tmpFilePath;

    return [
        'destination' => $tmpFilePath,
        'filename' => function ($req, $file) {
            // Gera um nome de arquivo aleatório usando um UUID e a extensão original do arquivo
            $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
            $fileName = uniqid() . '.' . $ext;
            return $fileName;
        },
        'limits' => [
            'fileSize' => 2 * 1024 * 1024 // Limite de tamanho do arquivo: 2MB
        ],
        'allowedExtensions' => ["jpg", "jpeg", "png", "gif"],
        'allowedMimes' => ["image/jpeg", "image/pjpeg", "image/png", "image/gif"]
    ];
}

// Função para verificar a extensão do arquivo permitida
function isExtensionAllowed($extension) {
    global $multerConfig;
    return in_array($extension, $multerConfig['allowedExtensions']);
}

// Função para verificar o tipo MIME do arquivo permitido
function isMimeTypeAllowed($mime) {
    global $multerConfig;
    return in_array($mime, $multerConfig['allowedMimes']);
}

// Exemplo de uso
if ($_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    // Erro no upload
    echo "Upload failed with error code: {$_FILES['file']['error']}";
} else {
    $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

    if (!isExtensionAllowed($ext)) {
        // Extensão não permitida
        echo "Invalid file extension: $ext";
    } elseif (!isMimeTypeAllowed($_FILES['file']['type'])) {
        // Tipo MIME não permitido
        echo "Invalid file type: {$_FILES['file']['type']}";
    } else {
        // Upload bem-sucedido
        $fileName = $multerConfig['filename'](null, $_FILES['file']);
        move_uploaded_file($_FILES['file']['tmp_name'], $multerConfig['destination'] . '/' . $fileName);
        echo "Upload successful!";
    }
}
?>
