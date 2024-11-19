<?php
namespace app\functions;

Class dateFunctions{

    public static function obterDatasDoMes() {
        // Definir o fuso horário para 'America/Sao_Paulo'
        date_default_timezone_set('America/Sao_Paulo');

        // Criar um objeto DateTime para a data atual
        $hoje = new \DateTime();

        // Obter o primeiro dia do mês atual
        $primeiroDia = new \DateTime($hoje->format('Y-m-01'));

        // Obter o último dia do mês atual
        $ultimoDia = new \DateTime($hoje->format('Y-m-t'));

        // Formatar as datas para o formato 'YYYY-MM-DD'
        $primeiroDiaFormatado = $primeiroDia->format('Y-m-d');
        $ultimoDiaFormatado = $ultimoDia->format('Y-m-d');

        // Retornar as duas datas em um array
        return [
            'primeiroDia' => $primeiroDiaFormatado,
            'ultimoDia'   => $ultimoDiaFormatado
        ];
    }

}



?>