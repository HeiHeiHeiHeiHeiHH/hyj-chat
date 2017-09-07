<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="x-ua-compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Mon_Cheri_HYJ</title>
    <link rel="shortcut icon" href="../../Image/favicon.ico" >
    <link href="../../Css/bootstrap.min.css" rel="stylesheet">
    <link href="../../Css/hyj.css" rel="stylesheet">
    <script src="../../Js/jquery.js" ></script>
    <script src="../../Js/hyj.js"></script>
    <script src="../../Js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        if (file_exists(CHAT_PATH . 'Tpl/' . $data['file'] . ".php")) {
            require_once CHAT_PATH . 'Tpl/' . $data['file'] . ".php";
        } else {
            echo "404 NOT FOUND!";
        }
    ?>
</body>
</html>
