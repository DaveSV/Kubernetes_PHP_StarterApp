# Kubernetes_PHP_StarterApp
 
Introducción a la Aplicación PHP de Ejemplo Kubernetes\_PHP\_StarterApp
=======================================================================

La aplicación PHP de ejemplo Kubernetes\_PHP\_StarterApp es un proyecto diseñado para demostrar cómo desplegar una aplicación web en un entorno de contenedores utilizando Kubernetes. En este texto, exploraremos los componentes clave de esta aplicación y cómo se construye la imagen de Docker que la soporta.

![image](https://github.com/user-attachments/assets/dd8b7219-95bb-46df-a223-1209e147221c)

Estructura de la Aplicación
---------------------------

La aplicación Kubernetes\_PHP\_StarterApp consta de un archivo **index.php** que se encarga de desplegar una imagen contenida en el directorio **/assets**. Esta estructura básica permite demostrar cómo se puede servir contenido web estático y dinámico desde un contenedor de Docker.

### Componentes de la Aplicación

*   **index.php**: archivo PHP que despliega la imagen
    
*   **/assets/**: directorio que contiene la imagen a desplegar
    

Construcción de la Imagen de Docker
-----------------------------------

La imagen de Docker para esta aplicación se construye utilizando el siguiente Dockerfile:

```
# Usar la imagen oficial de PHP con Apache
FROM php:8.3-apache

# Copiar el código PHP y la imagen
COPY . /var/www/html/

# Copiar el script de inicio
COPY startup.sh /usr/local/bin/startup.sh

# Darle permisos dentro del contenedor
RUN chmod +x /usr/local/bin/startup.sh

# Usar el script como punto de entrada
ENTRYPOINT ["/usr/local/bin/startup.sh"]
```

Este Dockerfile utiliza la imagen oficial de PHP 8.3 con Apache como base, lo que proporciona un entorno de ejecución listo para usar para aplicaciones PHP.

### Pasos del Dockerfile

1.  **Usar la imagen oficial de PHP con Apache**: se utiliza la imagen **php:8.3-apache** como base para la imagen de Docker.
    
2.  **Copiar el código PHP y la imagen**: se copian los archivos del directorio actual (que incluye el **index.php** y la imagen en **/assets**) al directorio **/var/www/html/** dentro del contenedor.
    
3.  **Copiar el script de inicio**: se copia el script **startup.sh** al directorio **/usr/local/bin/** dentro del contenedor.
    
4.  **Darle permisos dentro del contenedor**: se otorgan permisos de ejecución al script **startup.sh**.
    
5.  **Usar el script como punto de entrada**: se configura el script **startup.sh** como el punto de entrada para el contenedor.

Crea la imagen con **docker build -t mi-aplicacion-php .**, despliega la imagen como contenedor con **docker run -p 8080:8080 --name mi-contenedor mi-aplicacion-php**
    

Despliegue en Kubernetes
------------------------

Una vez construida la imagen de Docker, se puede desplegar en un cluster de Kubernetes. Esto implica crear un Deployment que especifique la imagen de Docker y configurar los servicios necesarios para acceder a la aplicación.
Usa el archivo **deployment.yaml** para hacer el despliegue:

```
apiVersion: apps/v1
kind: Deployment
metadata:
  name: mi-aplicacion-php
spec:
  replicas: 1
  selector:
    matchLabels:
      app: mi-aplicacion-php
  template:
    metadata:
      labels:
        app: mi-aplicacion-php
    spec:
      containers:
      - name: mi-contenedor
        image: mi-aplicacion-php
        ports:
        - containerPort: 8080
---
apiVersion: v1
kind: Service
metadata:
  name: mi-servicio-php
spec:
  selector:
    app: mi-aplicacion-php
  ports:
  - name: http
    port: 8080
    targetPort: 8080
  type: NodePort
```
Explicación de los componentes:

*   **Deployment**: define el despliegue de la aplicación.
    
    *   **metadata**: metadatos del despliegue.
        
    *   **spec**: especificaciones del despliegue.
        
        *   **replicas**: número de réplicas de la aplicación (en este caso, 1).
            
        *   **selector**: selector de pods que se van a desplegar.
            
        *   **template**: plantilla para crear los pods.
            
            *   **metadata**: metadatos del pod.
                
            *   **spec**: especificaciones del pod.
                
                *   **containers**: lista de contenedores que se van a ejecutar en el pod.
                    
                    *   **name**: nombre del contenedor.
                        
                    *   **image**: imagen de Docker que se va a utilizar.
                        
                    *   **ports**: lista de puertos que se van a exponer.
                        
*   **Service**: define el servicio que se va a utilizar para acceder a la aplicación.
    
    *   **metadata**: metadatos del servicio.
        
    *   **spec**: especificaciones del servicio.
        
        *   **selector**: selector de pods que se van a utilizar para el servicio.
            
        *   **ports**: lista de puertos que se van a exponer.
            
        *   **type**: tipo de servicio (en este caso, **NodePort**).
            

Para aplicar este archivo YAML, puedes utilizar el comando **kubectl apply -f deployment.yaml**.

Una vez aplicado, puedes verificar el estado del despliegue con **kubectl get deployments** y **kubectl get pods**. También puedes acceder a la aplicación utilizando el comando **kubectl port-forward** o configurando un ingress para acceder a la aplicación desde fuera del cluster.

### Ventajas de utilizar Kubernetes

*   **Escalabilidad**: se puede escalar la aplicación según sea necesario.
    
*   **Disponibilidad**: se puede garantizar la disponibilidad de la aplicación.
    
*   **Seguridad**: se puede configurar la seguridad de la aplicación.
    

La aplicación PHP de ejemplo Kubernetes\_PHP\_StarterApp ofrece una introducción práctica a cómo desplegar aplicaciones web en un entorno de contenedores utilizando Kubernetes. Al comprender cómo se construye la imagen de Docker y cómo se despliega en Kubernetes, los desarrolladores pueden aprovechar las ventajas de la contenerización y la orquestación para crear aplicaciones web escalables y fiables.


