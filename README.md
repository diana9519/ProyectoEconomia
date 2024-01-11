# Aplicación web - Sistema de amortización 
Es una aplicación desarrollada para ser utilizada en el ámbito financiero y contable para planificar el pago de una deuda a lo largo del tiempo. Este sistema cuenta con dos sistemas de amortización, el Alemán y Francés.
## Herramientas utilizadas
<img src="https://cdn-icons-png.flaticon.com/512/174/174854.png" title="HTML5" alt="HTML" width="40" height="40"/>&nbsp;
<img src="https://cdn.icon-icons.com/icons2/2107/PNG/512/file_type_css_icon_130661.png"  title="CSS3" alt="CSS" width="40" height="40"/>&nbsp;
<img src="https://cdn.icon-icons.com/icons2/2415/PNG/512/mysql_original_wordmark_logo_icon_146417.png" title="MySQL"  alt="MySQL" width="40" height="40"/>&nbsp;
## 👣 Primeros Pasos

Estas instrucciones te guiarán en la configuración y ejecución de la aplicación en tu entorno local para propósitos de desarrollo y pruebas.

### ✔️ Prerrequisitos

Asegúrate de tener instalado lo siguiente:

- [Servidor web](https://www.apachefriends.org/download.html)
  Para este proyecto se utilizó el servidor Apache proporcionado por la herramienta XAMPP [🔗](https://www.apachefriends.org/download.html) pero también puedes utilizar otros servidores similares de tu preferencia.
  💡 Recuerda que este proyecto utiliza PHP y JavaScript. Verifica la compatibilidad con la herramienta que elijas.
  
### ⚙️ Instalación

1. Clona el repositorio en tu máquina local dentro de htdocs del directorio de XAMPP:

```bash
https://github.com/diana9519/ProyectoEconomia.git
```

2. Verificación del funcionamiento
Cuando levantes Apache en XAMPP podrás acceder ya a la app con localhost.
![Localhost](https://github.com/diana9519/ProyectoEconomia/blob/main/assets/imgInicio.png)


## 💻 Uso

#### Login
Te permitirá ingresar como administrador.
![Localhost](https://github.com/diana9519/ProyectoEconomia/blob/main/assets/imgInicioSesion.png)
#### Gestión de la Información de la Intitución Financiera
En esta interfaz se encuentra implementado un CRUD para las Instituciones a excepción de la eliminación con el fin de mantener la integridad de los datos. Recordar que ha esta información solo puede acceder el Administrador.
![Localhost](https://github.com/diana9519/ProyectoEconomia/blob/main/assets/imgInicioAdmin.png)

#### Gestión de las Tasas de Interés
En esta interfaz se encuentra implementado un CRUD para la tasa de interés a excepción de la eliminación con el fin de mantener la integridad de los datos. Esta tasa de interés va a depender netamente de el tpo de crédito. 
![Localhost](https://github.com/diana9519/ProyectoEconomia/blob/main/assets/imgTasa.png)

#### Perfil de Usuario
En esta interfaz se generan las tablas de amortización ya sea Francés o Alemán para ello se debe llenar los campos correctamente. 
![Localhost](https://github.com/diana9519/ProyectoEconomia/blob/main/assets/imgDatos.png)

#### Generación de la Tabla de Amortización
Al dar clic en generar las tablas se cargarán con los datos correspondientes
![Localhost](https://github.com/diana9519/ProyectoEconomia/blob/main/assets/imgTabla.png)
#### Generación del Reporte
Al dar clic en generar PDF se va a descargar un archivo en formato pdf con la información de la amortización que se generó
![Localhost](https://github.com/diana9519/ProyectoEconomia/blob/main/assets/imgReporte.png)

## 🤝 Contribución
Si deseas contribuir a este proyecto, sigue los siguientes pasos:

1. Haz un fork del repositorio.
2. Crea una nueva rama:
```bash
git checkout -b nombre-de-la-rama
```
3. Realiza los cambios y haz commit:
```bash
git commit -m "Descripción de los cambios"
```
4. Envía los cambios a tu fork:
```bash
git push origin nombre-de-la-rama
```
5. Crea una pull request en este repositorio.

## ©️ Licencia
Este proyecto académico no tiene una licencia específica asignada. Todos los derechos de autor pertenecen a los miembros del equipo de desarrollo. Ten en cuenta que esto significa que no se otorgan permisos explícitos para utilizar, modificar o distribuir el código fuente o los archivos relacionados. Cualquier uso, reproducción o distribución del proyecto debe obtener permiso previo.
## 📧 Contacto
Si tienes alguna pregunta o comentario, puedes contactarte con los miembros del equipo de desarrollo:

* dpinchao9519@uta.edu.ec
* amiranda0902@uta.edu.ec
* svillacres6104@uta.edu.ec
