document.addEventListener('DOMContentLoaded', () => {
    fetch('utilidades.php')
        .then(response => response.json())
        .then(meses => {
            console.log(meses);
            crearGrafica(meses);
        })
        .catch(error => console.log(error));

function crearGrafica(meses) {
    var ctx = document.getElementById('utilidades').getContext('2d');
    let array = [];
    if (!Array.isArray(meses)) {
        array = Object.values(meses);
    }
    var chart = new Chart(ctx, {
        type: 'line',  // Tipo de gráfico (por ejemplo, bar, line, pie, etc.)
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
                label: 'Utilidades mensuales', // nombre de la serie de datos
                data: array,  // datos para el eje Y
                backgroundColor: 'rgba(255, 165, 0, 0.2)', // color de fondo
                borderColor: 'rgba(255, 165, 0, 0.2)', // color del borde
                borderWidth: 1, // ancho del borde
                borderRadius: 5, // radio del borde
                pointBackgroundColor: 'rgba(255, 165, 0, 1)' // color de los puntos (marcadores)
            }] // fin datasets
        }, // fin data
        options: { // opciones generales
                layout: {
                    padding: {
                        left: 10, // Ajusta el padding izquierdo
                        right: 10, // Ajusta el padding derecho
                        top: 10, // Ajusta el padding superior
                        bottom: 10 // Ajusta el padding inferior
                    }
                },
                scales: { // opciones de los ejes
                    y: { // opciones del eje Y
                        beginAtZero: true, // indica que el eje Y debe empezar en 0
                    },
                responsive: true, // Hace que la gráfica se ajuste al contenedor
                maintainAspectRatio: false // Evita que la gráfica mantenga una relación de aspecto fija
            }
        }
    });
}
});

