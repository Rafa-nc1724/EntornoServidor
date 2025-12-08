<?php

session_name("user");
session_start();

echo "<button><a href='cerrarSesion.php'>Salir</a></button>";
echo "<button><a href='inicio.php'>Volver</a></button>";
echo "<p>Bienvenido $_SESSION[nombre] $_SESSION[apellido] </p>";

echo "<h3>Tus datos</h3>";
echo "<p>Direccion: $_SESSION[dir]</p>";
echo "<p>Localidad: $_SESSION[loc]</p>";
echo "<p>Color de letra: $_SESSION[cl]</p>";
echo "<p>Color de fondo: $_SESSION[cf]</p>";
echo "<p>Tipo de letra: $_SESSION[tl]</p>";
echo "<p>Tamaño de letra: $_SESSION[sl]</p>";

    