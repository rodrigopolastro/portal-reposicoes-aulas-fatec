<?php
session_start();
include '../database/conexao-banco.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT USR_id, USR_tipo, USR_senha FROM USUARIOS WHERE USR_email = :email";
    $stmt = $conexao->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user['USR_senha'] === $senha) {
            $_SESSION['user_id'] = $user['USR_id'];
            $_SESSION['user_tipo'] = $user['USR_tipo'];

            
            switch ($user['USR_tipo']) {
                case 'admin':
                    header("Location: admin.php");
                    break;
                case 'professor':
                    header("Location: ./professor/index.php");
                    break;
                case 'coordenador':
                    header("Location: ./coordenador/index.php");
                    break;
                case 'secretaria':
                    header("Location: ./secretaria/index.html");
                    break;
                default:
                    echo "Tipo de usuário inválido.";
                    exit;
            }
            exit;
        } else {
            echo "Senha incorreta.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>
