<?php

namespace App\Helpers;

class Helpers
{
    public static function formatMoney(float $value, int $precision = 2): string
    {
        return "R$ " . number_format($value, $precision, ',','.');
    }

    public static function formatDateSimple(string $date): string
    {
        return $date = date('d/m/Y', strtotime($date));
    }

    public static function formatDateHour(string $date): string
    {
        $d = date('d/m/Y', strtotime($date));
        $h = date('H:i', strtotime($date));

        return $d ." às ".$h;
    }

    public static function Hour(string $date): string
    {
        return date('H:i', strtotime($date));
    }

    public static function formatInterest(float $value, int $precision = 1): string
    {
        return number_format($value, $precision, '.','.') . "%";
    }

    public static function formatDocument(string $value): string
    {
        $cnpj_cpf = preg_replace("/\D/", '', $value);
        $result = $value;

        if (strlen($cnpj_cpf) === 11) {
            $result = preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
        } elseif (strlen($cnpj_cpf) === 14) {
            $result = preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
        }

        return $result;
    }

    public static function formatPhone(string $telefone): string
    {
        $size = strlen($telefone);
        $string = preg_replace("[^0-9]", "", $telefone);

        if ($size === 10) {
            $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 4) . '-' . substr($string, 6);
        } else if ($size === 11) {
            $string = '(' . substr($string, 0, 2) . ') ' . substr($string, 2, 5) . '-' . substr($string, 7);
        }
        return $string;
    }

    public static function formatZipcode(string $cep): string
    {
        $string = preg_replace("[^0-9]", "", $cep);
        return substr($string, 0, 5) . '-' . substr($string, 5, 3);
    }

    public static function groupByMonth($data)
    {
        $months = [
            '1' => 'Janeiro',
            '2' => 'Fevereiro',
            '3' => 'Março',
            '4' => 'Abril',
            '5' => 'Maio',
            '6' => 'Junho',
            '7' => 'Julho',
            '8' => 'Agosto',
            '9' => 'Setembro',
            '10' => 'Outubro',
            '11' => 'Novembro',
            '12' => 'Dezembro'
        ];

        usort($data, function($a, $b) {
            return $a->month >= $b->month;
        });

        $dataMonths = [];

        foreach ($data as $d) {
            $dataMonths[$months[$d->month]][] = $d;
        }

        return $dataMonths;
    }
}
