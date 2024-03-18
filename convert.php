<?php
// Ruta completa de la carpeta de destino
$target_dir = "C:\\Users\\damia\\Downloads\\carpeta de descarga de videos\\";

// Ruta completa al ejecutable de FFmpeg
$ffmpeg_path = "C:\\webm\\bin\\ffmpeg.exe";

// Verificar si se ha enviado un archivo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $format = $_POST["format"];
    $original_filename = pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME);
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo ya existe
    $counter = 1;
    while (file_exists($target_file)) {
        $target_file = $target_dir . $original_filename . "_" . $counter . "." . $fileType;
        $counter++;
    }

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
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            // Realizar la conversión utilizando FFmpeg
            $output_file = $target_dir . $original_filename . "_convertido." . $format;
            $ffmpeg_command = $ffmpeg_path . " -i \"" . $target_file . "\" \"" . $output_file . "\" 2>&1";

            // Ejecutar el comando FFmpeg
            exec($ffmpeg_command, $output, $return_var);

            if ($return_var === 0 && file_exists($output_file)) {
                // Devolver la ubicación del archivo convertido
                echo $output_file;
                // Eliminar el archivo original si se convirtió correctamente
                unlink($target_file);
            } else {
                echo "Error al convertir el archivo. Detalles del error: " . implode("<br>", $output);
            }

        } else {
            echo "Error al subir el archivo.";
        }
    }
} else {
    echo "Error: No se ha seleccionado ningún archivo.";
}
?>
