document.addEventListener('DOMContentLoaded', function() {
    const botonAgregar = document.getElementById('agregar');
    const selectProducto = document.getElementById('idProducto');
    const inputCantidad = document.getElementById('cantidad');
    const listaProductos = document.getElementById('listaProductos');
    const existenciasAlert = document.getElementById('existenciasAlert');
    const ventaData = []; // Arreglo para almacenar los datos de la venta

    botonAgregar.addEventListener('click', function() {
        const productoSeleccionado = selectProducto.value;
        const cantidad = inputCantidad.value;
        const existencias = parseInt(selectProducto.options[selectProducto.selectedIndex].getAttribute('data-existencias'));
        // Validar que se haya seleccionado un producto
        if (productoSeleccionado === '0') {
            existenciasAlert.classList.add('bg-danger', 'text-black', 'rounded', 'p-2', 'my-3');
            const titulo = document.createElement('h6');
            titulo.textContent = 'Seleccione un producto.';
            existenciasAlert.appendChild(titulo);
            return;
        }
        existenciasAlert.innerHTML = '';
        if(cantidad <= existencias && cantidad > 0){
            // Agregar el producto y cantidad al arreglo de datos de la venta
            ventaData.push({
                id: parseInt(productoSeleccionado), // Convertir a entero
                cantidad: parseInt(cantidad) // Convertir a entero
            });

            // Mostrar el producto seleccionado en la lista
            listaProductos.classList.add("list-group-item", "my-3");
            const listItem = document.createElement('li');
            listItem.textContent = `Producto: ${selectProducto.options[selectProducto.selectedIndex].text}  Piezas: ${cantidad}`;
            listaProductos.appendChild(listItem);

            // Limpiar los campos después de agregar el producto
            selectProducto.value = '0';
            inputCantidad.value = '1';
        }if(cantidad <= 0){
            existenciasAlert.classList.add('bg-danger', 'text-black', 'rounded', 'p-2', 'my-3');
            const titulo = document.createElement('h6');
            titulo.textContent = 'Agrega una minimo 1 pieza. Disponibles: ' + existencias;
            existenciasAlert.appendChild(titulo);
        }else if(cantidad > existencias){
            existenciasAlert.classList.add('bg-danger', 'text-black', 'rounded', 'p-2', 'my-3');
            const titulo = document.createElement('h6');
            titulo.textContent = 'No hay suficientes existencias para este producto. Disponibles: ' + existencias;
            existenciasAlert.appendChild(titulo);
        }
    });

    const guardarVentaButton = document.getElementById('guardarVenta');

    guardarVentaButton.addEventListener('click', function() {
        if (ventaData.length === 0) {
            alert('Agrega al menos un producto antes de guardar la venta.');
            return;
        }

        // Enviar los datos de la venta al servidor
        fetch('guardar_venta.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(ventaData)
        })
        .then(response => response.json())
        .then(data => {
            console.log('Venta guardada con éxito:', data);
            // Redirigir o mostrar un mensaje de éxito
            window.location.href = 'venta.php';
        })
        .catch(error => {
            console.error('Error al guardar la venta:', error);
            alert('Error al guardar la venta. Consulta la consola para más detalles.');
        });
    });
});
