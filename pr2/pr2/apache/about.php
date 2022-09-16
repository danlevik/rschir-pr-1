<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>О сервере</title>
</head>
<body>

<?php

function ls() {
  $output = null;
  $retval = null;
  exec("ls", $output, $retval);
  echo "<p>Файлы на сервере: ".implode(", ", $output)."</p>";
}

function ps() {
  $output = null;
  $retval = null;
  exec("ps", $output, $retval);
  echo "<p>Текущие процессы на сервере: </p>";
  for ($i = 0; $i < count($output); $i++) {
    echo "<p>".$output[$i]."</p>";
  }
}

function whoami() {
  // выводит имя пользователя, от имени которого запущен процесс php/httpd
  // (применимо к системам с командой "whoami" в системном пути)
  $output=null;
  $retval=null;
  exec('whoami', $output, $retval);
  echo "<p>Имя пользователя: ".$output[0]."</p>";
}

function id() {
  $output=null;
  $retval=null;
  exec('id', $output, $retval);
  echo "<p>Информация об учетной записи текущего пользователя: ".$output[0]."</p>";
}

ls();
ps();
whoami();
id();
?>
</body>
</html>