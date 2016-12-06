padel4all
=========

* Proyecto Fin de Ciclo del C.F.G.S. Desarrollo de Aplicaciones Web.
* Alumno: Álvaro Galán Galindo
* I.E.S. Albarregas
* Curso lectivo: 2016/2017

## Descripción del proyecto
padel4all consiste en una aplicación web desarrollada con el framework Symfony en su versión 2.8 (Long Term Support).

Estas son algunas de las características funcionales básicas del sitio:
* Autenticación de usuarios por login y contraseña
* Perfil de usuario
* Roles de usuario (administrador y usuario registrado)
* Gestión de pistas
* Gestión de partidos
* Gestión de resultados
* Estadísticas de partidos y resultados

## Tecnologías empleadas
A continuación se describen las tecnologías que se han utilizado en el desarrollo de la aplicación:
* Symfony
* Composer
* Twig
* HTML5
* CSS3
* Less
* Grunt ()+ npm + node.js)
* animate.css
* Twitter Bootstrap
* jQuery
* MySQL
* phpMyAdmin
* Git y GitHub
* Heroku
* ...

## DataFixtures: Carga de la base de datos
Se ha capacitado al proyecto con unos DataFixtures para cargar la base de datos con datos de prueba para poder utilizarla sin perder demasiado tiempo. Para ello basta con lanzar los siguientes comandos para crear la base de datos, actualizar el esquema y generar los datos:

*$ app/console doctrine:database:create*
*$ app/console doctrine:schema:create*
*$ app/console doctrine:fixtures:load*

Tras lanzarlos se podrá contar con un administrador con usuario "admin" y contraseña "admin" y se podrá acceder con cualquier otro usuario que se observe en la aplicación con contraseña "usuario"

También se dispondrá de datos de pistas, partidos y resultados relacionados, con usuarios asignados.