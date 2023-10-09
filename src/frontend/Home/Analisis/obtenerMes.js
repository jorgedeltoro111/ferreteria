function getMes(){
    return document.getElementById('selectMes').value;
}
function enviarSolicitud() {
    let mes = getMes();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "actualizarTabla.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                // Actualizar la tabla con la respuesta
                document.getElementById('tablaProductosContainer').innerHTML = xhr.responseText;
            } else {
                console.error("Error en la solicitud:", xhr.statusText);
            }
        }
    };

    xhr.send("mes=" + mes);
}
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('selectMes').addEventListener('change', enviarSolicitud);
});

