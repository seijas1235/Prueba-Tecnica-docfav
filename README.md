
# Registro de Usuarios

Aplicación PHP para registrar usuarios

## Requisitos
- PHP 8.x  
- Composer  
- MySQL  
- Docker (opcional)  
- Docker Compose (opcional)  

## Instalación sin Docker
1. Clonar el repositorio:  
    ```bash
    git clone https://github.com/seijas1235/Prueba-Tecnica-docfav.git
    cd Prueba-Tecnica-docfav
    ```
2. Instalar dependencias:
    ```bash
    composer install
    ```
3. Configurar la conexión a MySQL en `bin/console`, `index.php` y `tests/Integration/DoctrineUserRepositoryTest.php`
4. Crear el esquema:
    ```bash
    php bin/console orm:schema-tool:update --force
    ```

## Instalación con Docker
1. Clonar el repositorio:
    ```bash
    git clone https://github.com/seijas1235/Prueba-Tecnica-docfav.git
    cd Prueba-Tecnica-docfav
    ```
2. Construir y levantar los contenedores:
    ```bash
    docker-compose up -d --build
    ```
3. Crear el esquema:
    ```bash
    docker-compose exec app php bin/console orm:schema-tool:update --force
    ```

## Uso
- Ejecutar la aplicación:
  - Con Docker:
     ```bash
     docker-compose exec app php index.php
     ```
  - Sin Docker:
     ```bash
     php index.php
     ```
- Correr pruebas:
  - Con Docker:
     ```bash
     docker-compose exec app vendor/bin/phpunit
     ```
  - Sin Docker:
     ```bash
     vendor/bin/phpunit
     ```

## Estructura
- `src/Domain`: Entidades, Value Objects, Repositorios, Eventos
- `src/Application`: Casos de uso y DTOs
- `src/Infrastructure`: Controladores, Persistencia, Listeners
- `tests`: Pruebas unitarias y de integración

## Probar Docker
Comandos:
```bash
docker-compose up -d --build
docker-compose exec app php bin/console orm:schema-tool:update --force
docker-compose exec app vendor/bin/phpunit
docker-compose exec app php index.php
```

## Actualizar Git con Docker
Comandos:
```bash
git add Dockerfile docker-compose.yml Makefile README.md bin/console index.php tests/Integration/DoctrineUserRepositoryTest.php
git commit --date="today 12:00:00" -m "Agregada configuración Docker con Dockerfile y docker-compose"
git push origin main
```

## Verificación
Comando para historial:
```bash
git log --pretty=format:"%h - %an, %ad : %s"
```

Comando para detener Docker:
```bash
docker-compose down
```
