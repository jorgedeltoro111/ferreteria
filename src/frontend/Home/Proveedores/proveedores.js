function redirigirAFormulario() {
// Obtener el valor seleccionado del select
var proveedorId = document.getElementById("clienteSelect").value;

// Redirigir a una página PHP con el clienteId como parámetro
window.location.href = "modificar.php?id=" + proveedorId;
}


