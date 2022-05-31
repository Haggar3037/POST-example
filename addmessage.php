<?php
try{
    $conn = new PDO("mysql:host=localhost;dbname=lern_bd", 'root', '');


    if (empty($_POST['name'])) exit("Поле не заполнено");
    if (empty($_POST['content'])) exit("Поле не заполнено");

    $query = "INSERT INTO message VALUES (NULL , :name, NOW())";
    $msg = $conn->prepare($query);
    $msg->execute(['name' => $_POST['name']]);

    print_r($conn->errorInfo());
    print_r("<br>");
    $msg_id = $conn->lastInsertId();
    print_r($conn->errorInfo());
    print_r("<br> msg_id = " . $msg_id . "<br>");

    $query = "INSERT INTO message_content VALUES (NULL , :content, :message_id)";
    $msg = $conn ->prepare($query);
    $msg->execute(['content' => $_POST['content'], 'message_id' => $msg_id]);
    print_r($conn->errorInfo());
}

catch (PDOException $e)
{
    echo "error";
}
?>