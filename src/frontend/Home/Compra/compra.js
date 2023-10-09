let total = 0;
let productos = [];
let proveedor = null;
function obtenerProveedorSeleccionado(proveedorId) {
  // Aquí puedes hacer lo que necesites con el ID del proveedor
  if(proveedor === null){
    proveedor = proveedorId;
    console.log(proveedor);
  }
}
function agregarNuevoProducto() {
  const nombre = document.getElementById('nombre').value;//nombre 
  const descripcion = document.getElementById('descripcion').value;//descripcion
  let precio = parseFloat(document.getElementById('precio').value);//precio
  const existencias =document.getElementById('existencias').value;//existencias
  const listaProductos = document.getElementById('listaProductos');
  //proveedor
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
    const producto = {
      nombre: nombre,
      descripcion: descripcion,
      precio: unitario,
      existencias: existencias,
      proveedor: proveedor
    };
    productos.push(producto);
    // Limpiar los campos
    document.getElementById('nombre').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('descripcion').value = '';
    document.getElementById('existencias').value = '';
  }
  console.log(productos);
}
function realizarCompra() {
  // Enviar los productos al servidor utilizando fetch

  fetch('realizar_compra.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      total: total,
      productos: productos,
      proveedor: proveedor
    })
  })
  .then(response => response.json())
  .catch(error => console.error('Error al realizar la compra:', error));
}

