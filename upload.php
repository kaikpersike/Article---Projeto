<?php

    // getting data images

    $data_img = $_FILES['image'];

    // uploading img dir

    $dir = 'imagens/uploads/';

    // making a key

    $key = substr(md5(rand()), 0, 16);
    $extension = pathinfo($data_img['name'], PATHINFO_EXTENSION);
    $name_upload = $key . "." . $extension;

    // move_uploaded_file($data_img['tmp_name'], $dir . $data_img['name']);
    move_uploaded_file($data_img['tmp_name'], $dir . $name_upload);

    $return['success'] = true;
    // $return['file'] = "https://i.imgur.com/7ZAsbjw.jpeg";
    // $return['file'] = "http://localhost/Article/post/imagens/uploads/" . $data_img['name'];
    $return['file'] = "http://article.x10.mx/imagens/uploads/" .  $name_upload;

   echo json_encode($return);

?>