function redirigirAFormulario() {
    // Obtener el valor seleccionado del select
    var productoId = document.getElementById("productoSelect").value;
    
    // Redirigir a una página PHP con el clienteId como parámetro
    window.location.href = "modificar.php?id=" + productoId;
    }
    
    
    