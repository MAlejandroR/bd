# Ejemplo realizado en clase

Lo clonáis o hacéis un fork

```bash
git clone https://github.com/MAlejandroR/bd.git
```
Una vez descargado lo primero creaís en **.env** a partir del fichero **env**

Podéis establecer las credenciales que queráis



Luego tenéis que orquestar con **composer**
Para crear el autoload y descargar la librería de **DotEnv**
```bash
composer update
```

Levantáis el contenedor
```bash
docker compose up -d
```

## Clase del martes

Hemos añadido funcionalidad nueva

Ahora cuando accedemos a sitio vemos todos las familias en un desplegable

Hasta aquí está implementado en este código


### Próximas acciones
Para la clase del jueves trataremos los siguientes asepctos
Ahora se trata de que al seleccionar una famlia concreta, nos muestre todos los productos de esa familia


Cada producto que lo podamos modificar y que se quede guardado


Aquí tienes una ejecución de esta práctica

http://manuel.infenlaces.com/contenido/practicas/practica_productos


