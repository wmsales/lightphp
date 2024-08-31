#!/bin/bash

DOCKER_COMPOSE_FILE="docker/docker-compose.yml"

echo "Seleccione el servidor web que desea usar:"
echo "1) Apache"
echo "2) Nginx"
read -p "Ingrese el número correspondiente (1 o 2): " server_choice

if [ "$server_choice" == "1" ]; then
    echo "Configurando Docker para usar Apache..."
    sed -i 's|context: ./nginx|context: ./apache|' $DOCKER_COMPOSE_FILE
elif [ "$server_choice" == "2" ]; then
    echo "Configurando Docker para usar Nginx..."
    sed -i 's|context: ./apache|context: ./nginx|' $DOCKER_COMPOSE_FILE
else
    echo "Opción inválida. Por favor, ejecute el script de nuevo y seleccione 1 o 2."
    exit 1
fi

echo "Docker esta configurado y listo para iniciar con el servidor seleccionado."
