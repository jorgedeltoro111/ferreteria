function redirigirAFormulario() {
    // Obtener el valor seleccionado del select
    var usuarioId = document.getElementById("usuarioSelect").value;
    
    // Redirigir a una página PHP con el clienteId como parámetro
    window.location.href = "modificar.php?id=" + usuarioId;
    }
    
    
    