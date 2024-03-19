body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.progress-container {
    width: 100%;
    background-color: #f0f0f0;
    border-radius: 5px;
    margin-top: 20px;
    position: relative; /* Necesario para posicionar la barra de progreso */
}

.progress-bar {
    width: 0%;
    height: 30px;
    background-color: #4caf50;
    text-align: center;
    line-height: 30px;
    color: white;
    border-radius: 5px;
    transition: width 0.3s ease; /* Transición suave para la animación */
}

/* Estilo para la ventana modal de descarga */
.modal {
    display: none; /* Por defecto oculto */
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background: linear-gradient(to bottom right, #3498db, #000); /* Fondo con degradado celeste a negro */
}

.modal-content {
    background-color: #fefefe;
    margin: 10% auto; /* Ajuste del margen superior para centrar mejor */
    padding: 20px;
    border-radius: 10px;
    max-width: 80%; /* Ancho máximo */
    text-align: center; /* Alineación del contenido */
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2); /* Sombra */
}

.close {
    color: #aaaaaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
