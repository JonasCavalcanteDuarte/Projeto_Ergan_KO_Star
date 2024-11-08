var ctx = document.getElementById('myChart');
var myChart;

// Função para atualizar o gráfico com dados filtrados
function updateChart(startDate, endDate) {
    fetch('./get_dash_data.php?start_date=' + startDate + '&end_date=' + endDate)
        .then(response => response.json())
        .then(data => {
            if (myChart) {
                myChart.destroy();
            }
            
            myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Valores',
                        data: data.values,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
}
// Event Listener para o filtro de data
document.getElementById('date-filter').addEventListener('submit', function(e) {
  e.preventDefault();
  const startDate = document.getElementById('start-date').value;
  const endDate = document.getElementById('end-date').value;
  updateChart(startDate, endDate);
});

// Carregar o gráfico com todos os dados inicialmente
updateChart('', '');