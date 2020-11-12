<!DOCTYPE HTML>
<html lang="ru">
<head>
  <meta charset="utf-8">
  <meta name="mobile-web-app-capable" content="yes">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Тестовое задание</title>
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
  <body>
    <div id="app"></div>
    <script src="{{ mix('js/app.js') }}"></script>
  </body>
</html>
