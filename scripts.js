// Función para mostrar ventana modal de éxito
function showSuccessModal(location) {
    var modal = document.getElementById("successModal");
    var downloadLocation = document.getElementById("downloadLocation");
    downloadLocation.innerText = location;
    modal.style.display = "block";
}

// Función para mostrar ventana modal de error
function showErrorModal() {
    var modal = document.getElementById("errorModal");
    modal.style.display = "block";
}

// Función para cerrar ventanas modales
function closeModal() {
    var modals = document.getElementsByClassName("modal");
    for (var i = 0; i < modals.length; i++) {
        modals[i].style.display = "none";
    }
}

// Evento para cerrar ventanas modales al hacer clic en la "X"
var closeButtons = document.getElementsByClassName("close");
for (var i = 0; i < closeButtons.length; i++) {
    closeButtons[i].addEventListener("click", closeModal);
}

// Evento para cerrar ventanas modales al hacer clic fuera de ellas
window.addEventListener("click", function(event) {
    if (event.target.classList.contains("modal")) {
        closeModal();
    }
});

// Envío del formulario
document.getElementById("uploadForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Evita el envío del formulario por defecto

    var formData = new FormData(this); // Obtiene los datos del formulario

    // Realiza una petición AJAX al servidor
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "convert.php", true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Si la petición es exitosa, muestra la ventana modal de éxito con la ubicación del archivo convertido
            showSuccessModal(xhr.responseText);
        } else {
            // Si hay un error, muestra la ventana modal de error
            showErrorModal();
        }
    };

    // Evento para actualizar la barra de progreso
    xhr.upload.addEventListener("progress", function(event) {
        var percent = (event.loaded / event.total) * 100;
        document.getElementById("progressBar").value = percent;
        document.getElementById("progressPercent").innerText = percent.toFixed(2) + "%";
    });

    xhr.send(formData);
});
s