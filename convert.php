<?php
// Ruta completa de la carpeta de descargas general
$target_dir = "/downloads/";

// Verificar si se ha enviado un archivo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $format = $_POST["format"];
    $original_filename = pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME);
    $uploadOk = 1;

    // Verificar el tamaño del archivo (5 GB)
    if ($_FILES["file"]["size"] > 5000000000) {
        echo "El archivo es demasiado grande. El tamaño máximo permitido es de 5 GB.";
        $uploadOk = 0;
    }

    // Permitir ciertos formatos de archivo
    $allowedFormats = array("mp4", "mp3", "mpeg", "mpeg2");
    if (!in_array($format, $allowedFormats)) {
        echo "Formato de salida no válido. Solo se permiten formatos MP4, MP3, MPEG y MPEG-2.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Error: No se puede subir el archivo.";
    } else {
        // Construir el nombre de archivo de destino con el formato especificado
        $output_file = $target_dir . $original_filename . "_convertido." . $format;

        if (move_uploaded_file($_FILES["file"]["tmp_name"], $output_file)) {
            echo $output_file; // Devolver la ruta del archivo convertido
        } else {
            echo "Error al subir el archivo o guardar el archivo convertido.";
        }
    }
} else {
    echo "Error: No se ha seleccionado ningún archivo.";
}
?>
