<?php
include 'connection.php';

if ($conn->connect_error) {
    $response = [
        'error' => true,
        'message' => 'Error en la conexión a la base de datos.'
    ];
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}

$firstName = htmlspecialchars($_POST['firstName']);
$lastName = htmlspecialchars($_POST['lastName']);
$phone = htmlspecialchars($_POST['phone']);
$dob = htmlspecialchars($_POST['dob']);
$gender = htmlspecialchars($_POST['gender']);

$checkSql = "SELECT * FROM church_members WHERE phone = ? OR (first_name = ? AND last_name = ?)";
if ($checkStmt = $conn->prepare($checkSql)) {
    $checkStmt->bind_param("sss", $phone, $firstName, $lastName);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if ($checkResult->num_rows > 0) {
        $response = [
            'error' => true,
            'message' => 'El número de teléfono o el nombre ya están registrados.'
        ];
    } else {
        $sql = "INSERT INTO church_members (first_name, last_name, phone, date_of_birth, gender) VALUES (?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $firstName, $lastName, $phone, $dob, $gender);

            if ($stmt->execute()) {
                $response = [
                    'error' => false,
                    'message' => 'Registro exitoso.'
                ];
            } else {
                $response = [
                    'error' => true,
                    'message' => 'Error al registrar en la base de datos.'
                ];
            }
            $stmt->close();
        } else {
            $response = [
                'error' => true,
                'message' => 'Error en la preparación de la consulta.'
            ];
        }
    }
    $checkStmt->close();
} else {
    $response = [
        'error' => true,
        'message' => 'Error en la preparación de la consulta de verificación.'
    ];
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
exit;
