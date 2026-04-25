<?php
require_once 'config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $asunto = trim($_POST["asunto"]);
    $comentario = trim($_POST["comentario"]);
    $fecha = date("Y-m-d H:i:s");

    if (!empty($nombre) && !empty($correo) && !empty($asunto) && !empty($comentario)) {
        try {
            $database = new Database();
            $db = $database->getConnection();

            $query = "INSERT INTO contacto (fecha, correo, nombre, asunto, comentario)
                      VALUES (:fecha, :correo, :nombre, :asunto, :comentario)";

            $stmt = $db->prepare($query);
            $stmt->bindParam(":fecha", $fecha);
            $stmt->bindParam(":correo", $correo);
            $stmt->bindParam(":nombre", $nombre);
            $stmt->bindParam(":asunto", $asunto);
            $stmt->bindParam(":comentario", $comentario);

            if ($stmt->execute()) {
                header("Location: contacto.php?success=1");
                exit;
            } else {
                header("Location: contacto.php?error=1");
                exit;
            }

        } catch (PDOException $e) {
            header("Location: contacto.php?error=1");
            exit;
        }
    } else {
        header("Location: contacto.php?error=1");
        exit;
    }
} else {
    header("Location: contacto.php");
    exit;
}
