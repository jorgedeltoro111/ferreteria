document.addEventListener('DOMContentLoaded', () => {
    fetch('datos-grafica.php')
        .then(response => response.json())
        .then(meses => {
            console.log(meses);
            crearGrafica(meses);
        })
        .catch(error => console.log(error));

function crearGrafica(meses) {
    var ctx = document.getElementById('ejemplo').getContext('2d');
    let array = [];
    if (!Array.isArray(meses)) {
        array = Object.values(meses);
    }
    var chart = new Chart(ctx, {
        type: 'bar',  // Tipo de gráfico (por ejemplo, bar, line, pie, etc.)
        data: { // Datos del gráfico
            labels: [
                'Enero',
                'Febrero',
                'Marzo',
                'Abril',
                'Mayo',
                'Junio',
                'Julio',
                'Agosto',
                'Septiembre',
                'Octubre',
                'Noviembre',
                'Diciembre'
            ], // datos para el eje X
            datasets: [{
                label: 'Ventas mensuales', // nombre de la serie de datos
                data: array,  // datos para el eje Y
                backgroundColor: 'rgba(75, 192, 192, 0.2)', // color de fondo
                borderColor: 'rgba(75, 192, 192, 1)', // color del borde
                borderWidth: 1, // ancho del borde
                borderRadius: 5 // radio del borde
            }] // fin datasets
        }, // fin data
        options: { // opciones generales
            scales: { // opciones de los ejes
                y: { // opciones del eje Y
                    beginAtZero: true, // indica que el eje Y debe empezar en 0
                    ticks: {
                        stepSize: 500, // Incremento entre los números en el eje Y
                        suggestedMin: 0, // Valor mínimo en el eje Y
                        suggestedMax: 100000 // Valor máximo en el eje Y
                    }
                },
                layout: {
                    padding: {
                        left: 10, // Ajusta el padding izquierdo
                        right: 10, // Ajusta el padding derecho
                        top: 10, // Ajusta el padding superior
                        bottom: 10 // Ajusta el padding inferior
                    }
                },
                responsive: true, // Hace que la gráfica se ajuste al contenedor
                maintainAspectRatio: false // Evita que la gráfica mantenga una relación de aspecto fija
            }
        }
    });
}
});

