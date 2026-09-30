# 🛡️ WebsVulnerables - Laboratorio de Hacking Web y Exámenes CTF

Bienvenido al repositorio **WebsVulnerables**. Este entorno está diseñado para la formación práctica, entrenamiento y evaluación de competencias en **ciberseguridad ofensiva y desarrollo web seguro (OWASP Top 10)**.

El proyecto implementa una arquitectura modular basada en **Docker** y **Docker Compose**, donde cada reto se ejecuta de forma aislada con su propio servidor web (Apache + PHP 8.2) y su base de datos relacional independiente (MySQL 8.0).

---

## 📋 Índice
- [Arquitectura y Tecnologías](#-arquitectura-y-tecnologías)
- [Escenarios y Retos Disponibles](#-escenarios-y-retos-disponibles)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Guía de Puesta en Marcha](#-guía-de-puesta-en-marcha)
- [Comandos de Administración y Diagnóstico](#-comandos-de-administración-y-diagnóstico)
- [Credenciales de Base de Datos](#-credenciales-de-base-de-datos)
- [Aviso Legal](#-aviso-legal)

---

## 🛠️ Arquitectura y Tecnologías

* **Servidor Web:** Docker container basado en `php:8.2-apache` con extensiones de base de datos activadas (`mysqli`, `pdo`, `pdo_mysql`).
* **Base de Datos:** Contenedores `mysql:8.0` con autenticación nativa compatible (`mysql_native_password`) y persistencia de datos montada en volúmenes locales.
* **Orquestación:** Docker Compose v3.8.
* **Aislamiento:** Cada escenario cuenta con su propia red, puerto expuesto al host y base de datos independiente.

---

## 🎯 Escenarios y Retos Disponibles

| Reto / Escenario | Temática | Puerto Web | Servicio BD | Vulnerabilidades y Mecánicas Principales |
| :--- | :--- | :--- | :--- | :--- |
| **Sitio 1** | **Estrella de la Muerte** (*Star Wars*) | [`http://localhost:54340`](http://localhost:54340) | `mysql_examen_1` (`deathstar`) | • **SQL Injection (SQLi)** en portal de login.<br>• **Command Injection (RCE)** en consola administrativa con bypass de whitelist de comandos.<br>• Búsqueda de secretos, flags y panel de ventilación térmica. |
| **Sitio 2** | **Barad-dûr / Mordor** (*El Señor de los Anillos*) | [`http://localhost:54350`](http://localhost:54350) | `mysql_examen_2` (`mordor`) | • **Path / Directory Traversal** en la biblioteca de pergaminos (`library.php`).<br>• **Stored XSS** en el muro orco (`mordor/wall.php`) con filtro débil de tags.<br>• **Session Hijacking** (cookie de sesión `lotrCookie` deliberadamente sin flag `HttpOnly`).<br>• Subida de archivos y paneles privados. |
| **Sitio 3** | **USS Enterprise** (*Star Trek*) | [`http://localhost:54360`](http://localhost:54360) | `mysql_examen_3` (`enterprise`) | • **Local File Inclusion (LFI) / Path Traversal** en selector de idioma (`?lang=`).<br>• **Stored XSS** en registro de tripulación con evasión de filtros (`alert`/`location`).<br>• **Arbitrary File Upload** en gestión de sistemas: bypass de validación débil por doble extensión (`.jpg.php`) para ejecución de WebShell.<br>• Acceso a logs clasificados y flags en `/dev`. |
| **Sitio 4** | **Plantilla / Reserva** | [`http://localhost:54370`](http://localhost:54370) | `mysql_examen_4` (`db_sitio4`) | • Contenedor preparado para nuevos exámenes o retos personalizados. |

---

## 📁 Estructura del Proyecto

```text
WebsVulnerables/
└── ExamenWeb/
    ├── docker-compose.yml       # Orquestador con los 8 servicios (4 webs + 4 bases de datos)
    ├── Dockerfile               # Imagen base para Apache + PHP 8.2 con mysqli/pdo
    ├── sitio1/                  # Escenario Star Wars (Puerto 54340)
    │   ├── html/                # Código fuente PHP (login, admin, terminal, reactor)
    │   └── db_data/             # Datos persistentes de MySQL (DB deathstar)
    ├── sitio2/                  # Escenario Mordor (Puerto 54350)
    │   ├── html/                # Código fuente PHP (biblioteca, muro, uploads, lore)
    │   └── db_data/             # Datos persistentes de MySQL (DB mordor)
    ├── sitio3/                  # Escenario Star Trek (Puerto 54360)
    │   ├── html/                # Código fuente PHP (puente, sistemas, uploads, logs)
    │   └── db_data/             # Datos persistentes de MySQL (DB enterprise)
    └── sitio4/                  # Escenario Reserva (Puerto 54370)
        ├── html/                # Directorio web listo para nuevos retos
        └── db_data/             # Datos persistentes de MySQL (DB db_sitio4)
```

---

## 🚀 Guía de Puesta en Marcha

### 1. Requisitos Previos

Asegúrate de tener instalados:
* **Docker Engine** (v20+ o superior)
* **Docker Compose** (v2+ o plugin integrado `docker compose`)

Verifícalo en tu terminal:
```bash
docker --version
docker compose version
```

---

### 2. Clonar el repositorio (si no lo has hecho)

```bash
git clone https://github.com/mmoraStucom/WebsVulnerables.git
cd WebsVulnerables
```

---

### 3. Iniciar los contenedores

Navega a la carpeta [ExamenWeb](file:///home/mmora/Documentos/home/ubuntu/WebsVulnerables/ExamenWeb) y arranca los servicios en segundo plano (`-d`):

```bash
cd ExamenWeb
docker compose up -d --build
```

> **Nota:** La primera vez, Docker descargará la imagen de `mysql:8.0` y compilará la imagen de Apache/PHP con las extensiones requeridas.

---

### 4. Comprobar que los servicios están activos

Verifica que todos los contenedores (`web_examen_*` y `mysql_examen_*`) estén en estado `Up`:

```bash
docker compose ps
```

Deberías ver una salida similar a:
```text
NAME             IMAGE          COMMAND                  SERVICE   STATUS         PORTS
mysql_examen_1   mysql:8.0      "docker-entrypoint.s…"   db1       Up             3306/tcp
mysql_examen_2   mysql:8.0      "docker-entrypoint.s…"   db2       Up             3306/tcp
mysql_examen_3   mysql:8.0      "docker-entrypoint.s…"   db3       Up             3306/tcp
mysql_examen_4   mysql:8.0      "docker-entrypoint.s…"   db4       Up             3306/tcp
web_examen_1     examenweb-web1 "docker-php-entrypoi…"   web1      Up             0.0.0.0:54340->80/tcp
web_examen_2     examenweb-web2 "docker-php-entrypoi…"   web2      Up             0.0.0.0:54350->80/tcp
web_examen_3     examenweb-web3 "docker-php-entrypoi…"   web3      Up             0.0.0.0:54360->80/tcp
web_examen_4     examenweb-web4 "docker-php-entrypoi…"   web4      Up             0.0.0.0:54370->80/tcp
```

---

### 5. Acceder a las aplicaciones

Abre tu navegador web y dirígete al reto deseado:

* 🌐 **Sitio 1 (Star Wars):** [http://localhost:54340](http://localhost:54340)
* 🌐 **Sitio 2 (Mordor):** [http://localhost:54350](http://localhost:54350)
* 🌐 **Sitio 3 (Star Trek):** [http://localhost:54360](http://localhost:54360)
* 🌐 **Sitio 4 (Reserva):** [http://localhost:54370](http://localhost:54370)

---

## 🔧 Comandos de Administración y Diagnóstico

### Ver logs en tiempo real
Para monitorizar el tráfico HTTP, errores de PHP o consultas:
```bash
# Ver logs de todos los servicios
docker compose logs -f

# Ver logs de un sitio específico (ej. sitio 1 web)
docker compose logs -f web1
```

### Reiniciar un contenedor específico
Si modificas archivos de configuración o necesitas reiniciar una base de datos:
```bash
docker compose restart web1
docker compose restart db1
```

### Detener el laboratorio
Para parar los contenedores sin borrar los datos:
```bash
docker compose stop
```

Para volver a reanudarlos:
```bash
docker compose start
```

### Apagar y desmontar los contenedores
Para parar y eliminar los contenedores (los volúmenes en disco local se conservan):
```bash
docker compose down
```

### Acceder a la consola de un contenedor web
Si necesitas auditar archivos o permisos directamente dentro de Apache:
```bash
docker exec -it web_examen_1 bash
```

### Acceder a la base de datos por CLI
Para revisar tablas, usuarios o inyectar datos manualmente:
```bash
# Sitio 1 (deathstar)
docker exec -it mysql_examen_1 mysql -u root -proot_pass_examen1 deathstar

# Sitio 2 (mordor)
docker exec -it mysql_examen_2 mysql -u root -proot_pass_examen2 mordor

# Sitio 3 (enterprise)
docker exec -it mysql_examen_3 mysql -u root -proot_pass_examen3 enterprise
```

---

## 🔑 Credenciales de Base de Datos

Las credenciales configuradas en el entorno son las siguientes:

| Servicio | Host interno Docker | Usuario | Contraseña | Base de datos |
| :--- | :--- | :--- | :--- | :--- |
| **db1** | `db1` | `root` | `root_pass_examen1` | `deathstar` / `db_sitio1` |
| **db2** | `db2` | `root` | `root_pass_examen2` | `mordor` / `db_sitio2` |
| **db3** | `db3` | `root` | `root_pass_examen3` | `enterprise` / `db_sitio3` |
| **db4** | `db4` | `root` | `root_pass_examen4` | `db_sitio4` |

---

## ⚠️ Aviso Legal

> [!IMPORTANT]
> Todo el software y los desafíos incluidos en este repositorio contienen vulnerabilidades deliberadas y están destinados **únicamente con fines educativos, académicos y de investigación en ciberseguridad**.
> El uso indebido de estas técnicas contra sistemas no autorizados es completamente ilegal. Los autores y colaboradores no se hacen responsables del mal uso de este material.