# Buffets

El proyecto "Buffets" es un sistema web integral diseñado para la gestión de pedidos y entregas de un buffet escolar.

A través de este sistema, los usuarios pueden realizar pedidos de los menús disponibles, y tienen la opción de pagar con créditos o en el momento de retirar su pedido.

Por otro lado, el personal del buffet utiliza el portal de administración para gestionar los pedidos, controlar los saldos y penalizaciones de los usuarios, y administrar los productos ofrecidos en el menú.

<div align="center">
  <img src="./Proyecto%20Buffets%20documentacion/images/image.png" height="200" alt="index page">
</div>

## Documentacion

La documentación completa del proyecto, que incluye el resumen, el informe de factibilidad, el diccionario de datos y los materiales relacionados con la JIFI (Jornada de Informatica de la Facultad de Ingenieria de la Universidad Atlantida) VIII, se puede encontrar en el directorio [docs](https://github.com/thiago-laurence/buffets/tree/main/Proyecto%20Buffets%20documentacion) del repositorio.


## Ejecución local

El único requisito para su ejecucón es contar con docker compose instalado.

Clonar el proyecto

```bash
  git clone https://github.com/thiago-laurence/buffets.git
```

Ir hacia el directorio del proyecto

```bash
  cd buffets
```

Iniciar los contenedores correspondientes a la base de datos MySQL y aplicación PHP

```bash
  docker compose up --build
```

El servidor web PHP inicia en el puerto 8080 del host

-  http://localhost:8080