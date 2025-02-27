# User Registration
# Aplicacion PHP para registrar usuarios usando DDD y Clean Architecture.

## Requisitos
- PHP 8.x  
- Composer  
- MySQL  

## Instalacion
1. Clonar repositorio:  
    ```bash
    git clone https://github.com/seijas1235/Prueba-Tecnica-docfav.git
    cd Prueba-Tecnica-docfav
    ```
2. Instalar dependencias:
    ```bash
    composer install
    ```
3. Configurar conexion MySQL en `bin/console`, `index.php` y `tests/Integration/DoctrineUserRepositoryTest.php`
4. Crear esquema:
    ```bash
    php bin/console orm:schema-tool:update --force
    ```
    
## Uso
- Ejecutar aplicacion:
    ```bash
    php index.php
    ```
- Correr pruebas:
    ```bash
    vendor/bin/phpunit
    ```

## Estructura
- `src/Domain`: Entidades, Value Objects, Repositorios, Eventos
- `src/Application`: Casos de uso y DTOs
- `src/Infrastructure`: Controladores, Persistencia, Listeners
- `tests`: Pruebas unitarias y de integracion
