<?php

namespace App\Exports;

use App\Models\Loan;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class PagosExports implements FromCollection,WithHeadings,WithMapping,ShouldAutoSize
{
    use Exportable;
    public function collection()
    {
        $prestamo = Loan::with('client')->orderBy('id')->get();
        return $prestamo;
    }

    public function map($prestamo) : array{
        return [
            $prestamo->id,
            $prestamo->client->name,
            $prestamo->amount,
            $prestamo->payments_number,
            $prestamo->fee,
            $prestamo->pagos_completados,
            $prestamo->saldo_abonado,
            $prestamo->saldo_pendiente,
            $prestamo->finalizado,
        ];
    }

    public function headings():array{
        return [
            '#',
            'Nombre',
            'Cantidad',
            'Cuota',
            'Número de Pagos',
            'Pagos Completados',
            'Saldo Abonado',
            'Saldo Pendiente'
        ];
    }
}
