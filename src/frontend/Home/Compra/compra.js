let total = 0;
    function agregarNuevoProducto() {
      const nombre = document.getElementById('nombre').value;
      const descripcion = document.getElementById('descripcion').value;
      let precio = parseFloat(document.getElementById('precio').value);
      const existencias =document.getElementById('existencias').value;
      const listaProductos = document.getElementById('listaProductos');

      if (nombre && precio && existencias) {
        // Crear un nuevo elemento para el producto
        let unitario = precio;
        precio = precio * existencias;
        total = total + precio;
        const nuevoProducto = document.createElement('li');
        nuevoProducto.className = 'list-group-item';
        nuevoProducto.textContent = `${nombre} - $${unitario} - ${existencias} unidades`;

        const totalElement = document.getElementById('total');
        totalElement.textContent = `Total: $${total.toFixed(2)}`;

        // Agregar el producto a la lista
        listaProductos.appendChild(nuevoProducto);

        // Limpiar los campos
        document.getElementById('nombre').value = '';
        document.getElementById('precio').value = '';
        document.getElementById('descripcion').value = '';
        document.getElementById('existencias').value = '';
      }
    }

