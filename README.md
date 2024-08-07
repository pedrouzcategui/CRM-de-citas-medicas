# CRM de citas médicas

Este es un proyecto de un CRM de citas médicas realizado en PHP vanilla, con el patrón de diseño MVC.

## Patrón de diseño elegido: MVC

Este proyecto tiene un patrón de diseño de tipo Modelo, Vista, Controlador, o MVC.

Este patrón busca definir la separación de responsabilidades mediante 3 conceptos:

- Modelos: Representan una entidad de la base de datos, al igual que las acciones que este puede tomar.
- Vista: Representa la interfaz final que el usuario ve, e interactua. Mediante las vistas, se pueden llamar a ejecutar acciones definidas en el controlador.
- Controlador: Representa el "cerebro" de la aplicación, procesando los datos, realizando operaciones y devolviendo resultados o vistas.

Hay varias razones por la cual se implementó este patrón:

- Evitar la duplicación de código y a su vez, fomenta la re-utilización de código
- Inyecta contenidos a templates definidos por el usuario
- Define rutas de manera más prágmática, que son maneja
  das por sus respectivos controladores

## Estructura de carpetas:

- db: La carpeta Database; o "db" de manera simplificada, contiene los archivos .csv usados en la aplicación:
  - appointments.csv
  - doctors.csv
  - patients.csv
- includes: Esta carpeta incluye dos archivos: `footer.php` y `header.php`, la cuales cargan estilos y dependencias del proyecto.
- public: Esta carpeta incluye todos los assets que se utilizan en la aplicación.
- src: La carpeta Source; o "src" de manera simplificada, contiene el código fuente de la aplicación, entre los cuales podemos ver las siguientes carpetas y archivos:
  - Controllers: Esta carpeta aloja los archivos de los controladores usados en el proyecto.
  - Models: Esta carpeta aloja los archivos de los modelos usados en el proyecto.
  - Views: Esta carpeta aloja los archivos de las vistas usadas en el proyecto.
  - Templates: Esta carpeta aloja los archivos de los templates usados en el proyecto.
  - Controller.php: Este archivo define la clase base de controlador.
  - Router.php: Este archivo define la clase base de Router.
  - routes.php: Este archivo contiene las rutas del proyecto, al igual que sus métodos de acceso.
- Vendor: Esta carpeta contiene las dependencias de PHP.
- composer.json: Esta carpeta contiene un JSON que se encarga del autoload de las clases del proyecto.
- config.php: Este archivo contiene una serie de constantes globales definidas y usadas en todo el proyecto.
- index.php: Este archivo es el punto de entrada principal de la aplicación, en donde se instancia un objecto de tipo Router, y se empiezan a recibir requests y responder con sus respectivos controladores y vistas.
- README.md: Lo que acabas de leer justo ahora.
