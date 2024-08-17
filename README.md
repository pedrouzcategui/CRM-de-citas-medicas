# CRM Medico

Este sistema es un CRM que permite a clínicas gestionar su personal médico, sus pacientes, citas e historial médico. Funciona con varios archivos .csv como base de datos y con PHP 8.

## Tech Stack

- XAMPP
- PHP 8

## Como instalar

1. Descarga el código como un ZIP
2. Guardalo en `TUUNIDADDEDISCODURO:`/xampp/htdocs/
3. Extrae todos los archivos, y elimina el zip
4. Activa Xampp
5. Accede a localhost/crmmedico

## Roles y permisos de la aplicación

- Adminstrador(a)
- Enfermero(a)
- Doctor(a)
- Master

## Credenciales de prueba:

- Administrador
  - **User:** test@test.com
  - **Password:** test
- Enfermero
  - **User:** test@test.com
  - **Password:** test
- Doctor
  - **User:** test@test.com
  - **Password:** test
- Master
  - **User:** test@test.com
  - **Password:** test

## Archivos independientes

Existe una serie de archivos independientes en la raiz de la aplicación

### Archivos de PHP

- **index.php:** Punto de entrada de la aplicación.
- **csv_functions.php:** Funciones para el manejo de operaciones con archivos tipo .csv (comma-separated values)
- **globals.php:** Archivo que define constantes usadas a lo largo del programa.
- **middleware.php:** Archivo con funciones que son utilizadas para manejar la autenticacion y las sesiones
- **notfound.php:** Archivo estandar para rutas no definidas en el sistema.
- **utils.php:** Archivo con funciones genéricas
- **image.png:** Es la imagen que viste al inicio del readme.

### Archivos de Estilos

- **styles.css**: Archivo de estilos globales de la aplicación.

# Carpetas de utilidades:

- **auth:** Carpeta donde se definen las rutas de login y logout.
- **components:** Carpeta donde se definen funciones de componentes.
- **partials:** Carpeta donde se incluyen elementos de HTML reutilizados a lo largo de la aplicación

# Carpetas de rutas

Estas carpetas contienen los archivos usados en cada una de las rutas de las aplicaciones

- **citas**
- **diagnosticos**
- **medicos**
- **pacientes**
- **users**

Cada una de estas carpetas a su vez, tiene 5 archivos:

- **index.php**: Renderiza una vista mostrando un formulario para agregar una entidad y una tabla que renderiza los registros actuales.
- **agregar.php**: Agrega una entidad en su CSV correspondiente.
- **editar.php**: Renderiza una vista para editar una entidad.
- **actualizar.php**: Actualiza una entidad en su CSV correspondiente.
- **eliminar.php**: Elimina una entidad de su CSV correspondiente.
- **entity.php**: Archivo de funciones PHP para crear, editar o eliminar usuarios.
- **`entidad`.csv**: Archivo de CSV correspondiente, donde `entidad` refiere al nombre de su carpeta.

Existe una diferencia en una de las carpetas: la carpeta `pacientes`, la cual incluye un archivo `history.php`, que se usa para realizar la visualiación del historial médico del paciente.
