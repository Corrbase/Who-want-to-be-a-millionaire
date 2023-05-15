<!doctype html>
<html lang="en">
<head>
    <title>Խաղի ընթացք</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Armenian&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="icon" href="/assets/img/logo.png">
    <!-- MDB -->

    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
    />
    <!-- Google Fonts -->
    <link
            href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
            rel="stylesheet"
    />
    <!-- MDB -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css"
            rel="stylesheet"
    />
    <style>
        *{
            font-family: 'Noto Sans Armenian', sans-serif;
        }
    </style>
</head>

<body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<header class="d-flex w-75 m-auto justify-content-between p-2">
    <form class=" justify-content-between d-flex">
        <?php
           $front = $view_array['front'];
        ?>
        <a href="javascript:void(0)" class="end_game m-2">
            <?php
            echo text($front, $language, 'end_game');
            ?>
        </a>
        <p class="m-2">
            <?php
            echo text($front, $language, 'muted_title');
            ?>
        </p>
    </form>
</header>

