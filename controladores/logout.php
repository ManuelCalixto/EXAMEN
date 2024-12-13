<?php
session_start();
session_destroy();
header("Location: Location:index.php?ruta=login");
die();
