<?php
unset($_SESSION['connected']);
unset($_SESSION['name']);
header("Location: index.php");