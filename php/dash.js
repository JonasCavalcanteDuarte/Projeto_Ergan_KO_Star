// Função para formatar a data no formato 'YYYY-MM-DD'
function formatDate(date) {
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0'); // Garantir que o mês tenha 2 dígitos
    const day = String(date.getDate()).padStart(2, '0'); // Garantir que o dia tenha 2 dígitos
    return `${year}-${month}-${day}`;
}
  
// Obter a data atual
const hoje = new Date();

// Primeiro dia do mês atual
const primeiroDia = new Date(hoje.getFullYear(), hoje.getMonth(), 1);

// Último dia do mês atual
const ultimoDia = new Date(hoje.getFullYear(), hoje.getMonth() + 1, 0);

// Formatar as datas
const primeiroDiaFormatado = formatDate(primeiroDia);
const ultimoDiaFormatado = formatDate(ultimoDia);

//console.log("Primeiro dia do mês:", primeiroDiaFormatado);
//console.log("Último dia do mês:", ultimoDiaFormatado);

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


var ctx2 = document.getElementById('myChart2');
var myChart2;

// Função para atualizar o gráfico com dados filtrados
function updateChart2(startDate, endDate) {
    fetch('./get_dash_data.php?start_date=' + startDate + '&end_date=' + endDate)
        .then(response => response.json())
        .then(data => {
            if (myChart2) {
                myChart2.destroy();
            }
            
            myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Valores',
                        data: data.values
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


var ctx3 = document.getElementById('myChart3');
var myChart3;

// Função para atualizar o gráfico com dados filtrados
function updateChart3(startDate, endDate) {
    fetch('./get_dash_data.php?start_date=' + startDate + '&end_date=' + endDate)
        .then(response => response.json())
        .then(data => {
            if (myChart3) {
                myChart3.destroy();
            }
            
            myChart3 = new Chart(ctx3, {
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
  updateChart2(startDate, endDate);
  updateChart3(startDate, endDate);
});

// Carregar o gráfico com todos os dados inicialmente
updateChart(primeiroDiaFormatado, ultimoDiaFormatado);
updateChart2(primeiroDiaFormatado, ultimoDiaFormatado);
updateChart3(primeiroDiaFormatado, ultimoDiaFormatado);