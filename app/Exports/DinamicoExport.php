<?php

namespace App\Exports;

use App\Parcela;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DinamicoExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\View
    */
    use Exportable;

    public function headings(): array
    {
        return [
            'Padrón',
            'Nomenclatura'
        ];
    }

    public function collection(){

        $query = Parcela::select('parcelas.*','tipos_parcelas_estados.tipo_parcela_estado_descrip as tipo_estado_parcela','tipos_parcelas_estados.tipo_parcela_estado_codigo as tipo_estado_codigo','tipos_parcelas_ryb.tipo_parcela_ryb_descrip as tipo_ryb')
      ->leftJoin('tipos_parcelas_estados','tipos_parcelas_estados.tipo_parcela_estado_id','=','parcelas.tipo_parcela_estado_id')
      ->leftJoin('tipos_parcelas_ryb','tipos_parcelas_ryb.tipo_parcela_ryb_id','=','parcelas.tipo_parcela_ryb_id')
      ->leftJoin('personas_parcelas','personas_parcelas.parcela_id','=','parcelas.parcela_id')
      ->leftJoin('personas','personas.persona_id','=','personas_parcelas.persona_id')
      ->leftJoin('mejoras','mejoras.parcela_id','=','parcelas.parcela_id');

        $sql = session('sentencia');

        $resultado = $query->whereRaw($sql)->get();

        return $resultado;
    }
}
