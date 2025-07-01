# Integrador Diseño y Aplicaciones en la Web (2025)
## Integrantes:
- Erreguerena Agustín Iñaki
- Fernandez Lautaro Agustín
- Fraga Facundo Román
- Piloni Fabrizio Julian

## Pasos de ejecución del sistema
### 1. Instalación de XAMPP (Apache + PHP + MySQL)
Abra tu navegador y vaya a la página oficial de XAMPP:
https://www.apachefriends.org/es/index.html

- Descargue el instalador de XAMPP para Windows.
- Ejecute el instalador y siga los pasos por defecto.
- Deje seleccionados Apache y MySQL.
- Finalizada la instalación, abra el Panel de Control de XAMPP y arranque los módulos:

  - Apache

  - MySQL

### 2. Instalación de Composer
En su navegador, diríjase a la web de Composer:
https://getcomposer.org/download/

- Descargue el instalador de Composer para Windows (Composer-Setup.exe).

- Ejecute el instalador y asegúrese de que detecte la ruta del ejecutable de PHP (incluida en XAMPP, normalmente C:\xampp\php\php.exe).

### 3. Preparar la base de datos
En el panel de control de XAMPP, junto a MySQL, haga clic en Admin para abrir phpMyAdmin.

- Cree una base de datos en phpMyAdmin, vaya a la pestaña SQL y pegue el siguiente script para crear las tablas:

```
-- Eliminar tablas en orden inverso al de dependencias
DROP TABLE IF EXISTS Ejemplar_Prestamo;
DROP TABLE IF EXISTS Ejemplares;
DROP TABLE IF EXISTS Catalogo_Subject;
DROP TABLE IF EXISTS Catalogo_Creator;
DROP TABLE IF EXISTS Prestamos;
DROP TABLE IF EXISTS Catalogos;
DROP TABLE IF EXISTS Proveedores;
DROP TABLE IF EXISTS Publishers;
DROP TABLE IF EXISTS Subjects;
DROP TABLE IF EXISTS Creators;
DROP TABLE IF EXISTS Miembros;
DROP TABLE IF EXISTS Bibliotecarios;

-- Tabla: Bibliotecarios
CREATE TABLE Bibliotecarios (
    id_bibliotecario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(10) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL
);

-- Tabla: Miembros
CREATE TABLE Miembros (
    id_miembro INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(50) NOT NULL,
    apellido VARCHAR(50) NOT NULL,
    dni VARCHAR(10) NOT NULL UNIQUE,
    correo VARCHAR(100) NOT NULL,
    telefono VARCHAR(50) NOT NULL,
    direccion VARCHAR(100) NOT NULL,
    tipo_miembro VARCHAR(50) NOT NULL,
    usuario VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(100) NOT NULL
);

-- Tabla: Creators
CREATE TABLE Creators (
    id_creator INT PRIMARY KEY AUTO_INCREMENT,
    creator VARCHAR(100) NOT NULL
);

-- Tabla: Subjects
CREATE TABLE Subjects (
    id_subject INT PRIMARY KEY AUTO_INCREMENT,
    subject VARCHAR(100) NOT NULL
);

-- Tabla: Publishers
CREATE TABLE Publishers (
    id_publisher INT PRIMARY KEY AUTO_INCREMENT,
    publisher VARCHAR(100) NOT NULL
);

-- Tabla: Proveedores
CREATE TABLE Proveedores (
    id_proveedor INT PRIMARY KEY AUTO_INCREMENT,
    proveedor VARCHAR(100)
);

-- Tabla: Catalogos
CREATE TABLE Catalogos (
    id_catalogo INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    date VARCHAR(30),
    identifier VARCHAR(100) UNIQUE,
    language VARCHAR(100),
    format VARCHAR(100),
    rights VARCHAR(100),
    type VARCHAR(100) NOT NULL,
    id_bibliotecario INT,
    id_publisher INT,
    FOREIGN KEY (id_bibliotecario) REFERENCES Bibliotecarios(id_bibliotecario),
    FOREIGN KEY (id_publisher) REFERENCES Publishers(id_publisher)
);

-- Tabla: Prestamos
CREATE TABLE Prestamos (
    id_prestamo INT PRIMARY KEY AUTO_INCREMENT,
    id_miembro INT,
    fecha_prestamo DATE NOT NULL,
    devuelto BOOL,
    FOREIGN KEY (id_miembro) REFERENCES Miembros(id_miembro)
);

-- Tabla: Catalogo_Creator
CREATE TABLE Catalogo_Creator (
    id_catalogo_creator INT AUTO_INCREMENT PRIMARY KEY,
    id_catalogo INT,
    id_creator INT,
    FOREIGN KEY (id_catalogo) REFERENCES Catalogos(id_catalogo),
    FOREIGN KEY (id_creator) REFERENCES Creators(id_creator)
);

-- Tabla: Catalogo_Subject
CREATE TABLE Catalogo_Subject (
    id_catalogo_subject INT AUTO_INCREMENT PRIMARY KEY,
    id_catalogo INT,
    id_subject INT,
    FOREIGN KEY (id_catalogo) REFERENCES Catalogos(id_catalogo),
    FOREIGN KEY (id_subject) REFERENCES Subjects(id_subject)
);

-- Tabla: Ejemplares
CREATE TABLE Ejemplares (
    id_ejemplar INT PRIMARY KEY AUTO_INCREMENT,
    id_publico VARCHAR(100) UNIQUE,
    ubicacion TEXT,
    procedencia VARCHAR(100),
    estado_material VARCHAR(50),
    disponibilidad VARCHAR(50),
    id_catalogo INT,
    id_proveedor INT,
    FOREIGN KEY (id_catalogo) REFERENCES Catalogos(id_catalogo),
    FOREIGN KEY (id_proveedor) REFERENCES Proveedores(id_proveedor)
);

-- Tabla: Ejemplar_Prestamo
CREATE TABLE Ejemplar_Prestamo (
    id_prestamo INT,
    id_ejemplar INT,
    PRIMARY KEY (id_prestamo, id_ejemplar),
    FOREIGN KEY (id_prestamo) REFERENCES Prestamos(id_prestamo),
    FOREIGN KEY (id_ejemplar) REFERENCES Ejemplares(id_ejemplar)
);
```
### 4. Descargar y preparar el proyecto Laravel
- Descargue el archivo ZIP desde la sección de Releases del repositorio.
- Extraiga la carpeta y cópiela dentro de C:\xampp\htdocs
- Renombre la carpeta al nombre definitivo de tu proyecto (por ejemplo, Grupo-C-Biblioteca-Estudiantil-Integrador-Web-2025).

### 5. Configurar variables de entorno
- Abra Visual Studio, y abrir la carpeta del proyecto ubicado en C:\xampp\htdocs
-  Ya ubicado en la carpeta del proyecto, dirigirse al archivo ".env.example".
-  Copiar y pegar el archivo ".env.example" en el propio proyecto, esto va a generar un archivo llamado ".env.copy.example", desde este nuevo archivo, tiene que borrar del nombre ".copy.example". Esto le dará como resultado que el archivo tenga el nombre ".env".
- Abra ".env" y ajuste estas variables según tu entorno:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306                  # El puerto por defecto de MySQL en XAMPP
DB_DATABASE=biblioteca        # Nombre de la base de datos creada
DB_USERNAME=root
DB_PASSWORD=                  # se le puede poner una contraseña
```
### 6. Instalar dependencias y preparar la aplicación

Abra la Terminal de Windows (CMD) o PowerShell y navegue hasta su proyecto:
```
"cd C:\xampp\htdocs\Grupo-C-Biblioteca-Estudiantil-Integrador-Web-2025"
```
Una vez ubicado, Ejecute los siguientes comandos uno a uno:

```
composer install              # 1. Instala dependencias de PHP
php artisan key:generate      # 2. Genera la clave de la aplicación
php artisan migrate           # 3. Aplica las migraciones a la base de datos
php artisan db:seed           # 4. Inserta datos de ejemplo (si existen seeders)
php artisan serve             # 5. Arranca el servidor de desarrollo
```
### 7. Acceder a la aplicación
Abra el navegador y navegue a:
```
https://127.0.0.1:8000
```
Debería ver la pantalla de inicio de sesión del sistema.