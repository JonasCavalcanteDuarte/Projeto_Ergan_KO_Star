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

var ctx = document.getElementById('qtdPedidos');
var ChartqtdPedidos;

// Função para atualizar o gráfico com dados filtrados
function updateChart(startDate, endDate) {
    var chart = "qtdPedidos";
    fetch('./get_dash_data.php?start_date=' + startDate + '&end_date=' + endDate + '&chart=' + chart)
        .then(response => response.json())
        .then(data => {
            if (ChartqtdPedidos) {
                ChartqtdPedidos.destroy();
            }
            
            ChartqtdPedidos = new Chart(ctx, {
                type: 'bar',
                grid: false,
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Qtd Pedidos',
                        data: data.values,
                        backgroundColor: 'rgba(43, 71, 252, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Quantidade de pedidos por data',
                            align: 'start',
                            color: 'black',
                            font: {
                                weight: 'bold',
                                size: 15
                            }
                        },
                        datalabels: {
                            color: 'black', // Cor do texto dos rótulos
                            font: {
                              weight: 'bold', // Peso da fonte
                              size: 14 // Tamanho da fonte
                            },
                            anchor: 'end', // Posição do rótulo em relação à barra
                            align: 'top', // Alinhar o rótulo ao topo
                            formatter: function(value) {
                              return value; // Exibe o valor do dado
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'start'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                              display: false
                            }
                          },
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false
                              }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Incluindo o plugin de rótulos de dados
            });
        });
}


var ctx2 = document.getElementById('qtdOrderStatus');
var ChartqtdOrderStatus;

// Função para atualizar o gráfico com dados filtrados
function updateChart2(startDate, endDate) {
    var chart = "qtdOrderStatus";
    fetch('./get_dash_data.php?start_date=' + startDate + '&end_date=' + endDate + '&chart=' + chart)
        .then(response => response.json())
        .then(data => {
            if (ChartqtdOrderStatus) {
                ChartqtdOrderStatus.destroy();
            }
            
            ChartqtdOrderStatus = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Qtd Pedidos',
                        data: data.values,
                        backgroundColor: 'rgba(43, 71, 252, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    plugins: {
                        title: {
                            display: true,
                            text: 'Quantidade de pedidos por status',
                            align: 'start',
                            color: 'black',
                            font: {
                                weight: 'bold',
                                size: 15
                            }
                        },
                        datalabels: {
                            color: 'black', // Cor do texto dos rótulos
                            font: {
                              weight: 'bold', // Peso da fonte
                              size: 14 // Tamanho da fonte
                            },
                            anchor: 'end', // Posição do rótulo em relação à barra
                            offset: -1,
                            align: 'end', // Alinhar o rótulo ao topo
                            formatter: function(value) {
                              return value; // Exibe o valor do dado
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'start'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                              display: false
                            }
                          },
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false
                              }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Incluindo o plugin de rótulos de dados
            });
        });
}


var ctx3 = document.getElementById('qtdProdVendidos');
var ChartqtdProdVendidos;

// Função para atualizar o gráfico com dados filtrados
function updateChart3(startDate, endDate, orderBy) {
    var chart = "qtdProdVendidos";
    fetch('./get_dash_data.php?start_date=' + startDate + '&end_date=' + endDate + '&chart=' + chart + '&order_by_clause=' + orderBy)
        .then(response => response.json())
        .then(data => {
            if (ChartqtdProdVendidos) {
                ChartqtdProdVendidos.destroy();
            }
            
            ChartqtdProdVendidos = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Qtd vendida',
                        data: data.values,
                        backgroundColor: 'rgba(43, 71, 252, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    plugins: {
                        title: {
                            display: true,
                            text: 'Quantidade de produtos por SKU',
                            align: 'start',
                            color: 'black',
                            font: {
                                weight: 'bold',
                                size: 15
                            }
                        },
                        datalabels: {
                            color: 'black', // Cor do texto dos rótulos
                            font: {
                              weight: 'bold', // Peso da fonte
                              size: 14 // Tamanho da fonte
                            },
                            anchor: 'end', // Posição do rótulo em relação à barra
                            offset: -1,
                            align: 'end', // Alinhar o rótulo ao topo
                            formatter: function(value) {
                              return value; // Exibe o valor do dado
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'start'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                              display: false
                            }
                          },
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false
                              }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Incluindo o plugin de rótulos de dados
            });
        });
}

var ctx4 = document.getElementById('vlVendas');
var ChartvlVendas;

// Função para atualizar o gráfico com dados filtrados
function updateChart4(startDate, endDate) {
    var chart = "vlVendas";
    fetch('./get_dash_data.php?start_date=' + startDate + '&end_date=' + endDate + '&chart=' + chart)
        .then(response => response.json())
        .then(data => {
            if (ChartvlVendas) {
                ChartvlVendas.destroy();
            }
            
            ChartvlVendas = new Chart(ctx4, {
                type: 'bar',
                grid: false,
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Valor Pedidos',
                        data: data.values,
                        backgroundColor: 'rgba(43, 71, 252, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Valor total de pedidos por data',
                            align: 'start',
                            color: 'black',
                            font: {
                                weight: 'bold',
                                size: 15
                            }
                        },
                        datalabels: {
                            display: 'auto',
                            color: 'black', // Cor do texto dos rótulos
                            font: {
                              weight: 'bold', // Peso da fonte
                              size: 14 // Tamanho da fonte
                            },
                            anchor: 'end', // Posição do rótulo em relação à barra
                            align: 'top', // Alinhar o rótulo ao topo
                            formatter: function(value) {
                              return value; // Exibe o valor do dado
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'start'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                              display: false
                            }
                          },
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false
                              }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Incluindo o plugin de rótulos de dados
            });
        });
}


var ctx5 = document.getElementById('qtdOrderPayment');
var ChartqtdOrderPayment;

// Função para atualizar o gráfico com dados filtrados
function updateChart5(startDate, endDate) {
    var chart = "OrderPayment";
    fetch('./get_dash_data.php?start_date=' + startDate + '&end_date=' + endDate + '&chart=' + chart)
        .then(response => response.json())
        .then(data => {
            if (ChartqtdOrderPayment) {
                ChartqtdOrderPayment.destroy();
            }
            
            ChartqtdOrderPayment = new Chart(ctx5, {
                type: 'bar',
                grid: false,
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Qtd Pedidos',
                        data: data.values,
                        backgroundColor: 'rgba(43, 71, 252, 0.7)'
                    }]
                },
                options: {
                    responsive: true,
                    indexAxis: 'y',
                    plugins: {
                        title: {
                            display: true,
                            text: 'Quantidade de pedidos por método de pagamento',
                            align: 'start',
                            color: 'black',
                            font: {
                                weight: 'bold',
                                size: 15
                            }
                        },
                        datalabels: {
                            //display: 'auto',
                            color: 'black', // Cor do texto dos rótulos
                            font: {
                              weight: 'bold', // Peso da fonte
                              size: 14 // Tamanho da fonte
                            },
                            anchor: 'end', // Posição do rótulo em relação à barra
                            offset: -1,
                            align: 'end', // Alinhar o rótulo ao topo
                            formatter: function(value) {
                              return value; // Exibe o valor do dado
                            }
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'start'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                              display: false
                            }
                          },
                        y: {
                            beginAtZero: true,
                            grid: {
                                display: false
                              }
                        }
                    }
                },
                plugins: [ChartDataLabels] // Incluindo o plugin de rótulos de dados
            });
        });
}

// Event Listener para o filtro de data
document.getElementById('date-filter').addEventListener('submit', function(e) {
  e.preventDefault();
  const startDate = document.getElementById('start-date').value;
  const endDate = document.getElementById('end-date').value;
  var orderBy = document.getElementById('order_by_clause').value;
  updateChart(startDate, endDate);
  updateChart2(startDate, endDate);
  updateChart3(startDate, endDate, orderBy);
  updateChart4(startDate, endDate);
  updateChart5(startDate, endDate);
});

// Event Listener para o filtro de data
document.getElementById('orderby-filter').addEventListener('submit', function(e) {
    e.preventDefault();
    const startDate = document.getElementById('start-date').value;
    const endDate = document.getElementById('end-date').value;
    var orderBy = document.getElementById('order_by_clause').value;
    updateChart3(startDate, endDate, orderBy);
  });

// Carregar o gráfico com todos os dados inicialmente
updateChart(primeiroDiaFormatado, ultimoDiaFormatado);
updateChart2(primeiroDiaFormatado, ultimoDiaFormatado);
var orderBy = "DESC";
updateChart3(primeiroDiaFormatado, ultimoDiaFormatado, orderBy);
updateChart4(primeiroDiaFormatado, ultimoDiaFormatado);
updateChart5(primeiroDiaFormatado, ultimoDiaFormatado);