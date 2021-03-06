<?php

namespace App;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;

class ModelProposta extends Model
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    static function Create(Request $request, $path, $id_cliente, $nm_cliente)
    {
        $id = auth()->user()->id;
        $id_cliente = $id_cliente;
        $nm_cliente = $nm_cliente;
        $nm_endereco_obra = $request->nm_endereco_obra;
        $vl_total = $request->vl_total;
        $vl_sinal = $request->vl_sinal;
        $qt_parcelas = $request->qt_parcelas;
        $vl_parcelas = $request->vl_parcelas;
        $dt_proposta = $request->dt_proposta;
        $dt_inicio = $request->dt_inicio;
        $ds_status = $request->ds_status;
        $path = $path;
        $data = new DateTime();
        $data = $data->format('Y-m-d H:i:s');
        $res = Db::insert(
            'INSERT INTO propostas 
            (created_at, updated_at, nm_cliente, ds_endereco, vl_total, 
            vl_sinal, qt_parcelas, vl_parcelas, dt_inicio_pagamento, dt_proposta, ds_status,
            ds_arquivo, id_cliente) 
            VALUES (:create_at, :update_at, :nm_cliente, :endereco_obra, :vl_total,:vl_sinal, :qt_parcelas, 
            :vl_parcelas, :dt_inicio, :dt_proposta, :ds_status, :ds_arquivo, :id_cliente
            )',
            [
                'create_at' => $data, 'update_at' => $data, 'nm_cliente' => $nm_cliente,
                'endereco_obra' => $nm_endereco_obra, 'vl_total' => $vl_total,
                'vl_sinal' => $vl_sinal, 'qt_parcelas' => $qt_parcelas, 'vl_parcelas' => $vl_parcelas,
                'dt_inicio' => $dt_inicio, 'dt_proposta' => $dt_proposta, 'ds_status' => $ds_status,
                'id_cliente' => $id_cliente, 'ds_arquivo' => $path
            ]
        );
        return $res;
    }
    static function select_proposta()
    {
        $id = auth()->user()->id;
        $res = Db::select(
            'SELECT C.id, C.nm_cliente, C.ds_endereco, C.vl_total, C.vl_sinal, 
            C.qt_parcelas, C.vl_parcelas, C.dt_inicio_pagamento,
            C.dt_proposta, C.ds_status, C.ds_arquivo,
            P.nm_razao 
            FROM propostas AS C 
            JOIN cliente AS P ON C.id_cliente = P.id Where id_user = :id',
            ['id' => $id]
        );
        return $res;
    }
    static function select_edit($id)
    {
        $res = Db::select(
            'SELECT * FROM db_marca_site.propostas where id = :id',
            ['id' => $id]
        );
        return $res;
    }
    static function update_proposta(Request $request)
    {
        $id_proposta = $request->id_proposta;
        $nm_endereco_obra = $request->nm_endereco_obra;
        $vl_total = $request->vl_total;
        $vl_sinal = $request->vl_sinal;
        $qt_parcelas = $request->qt_parcelas;
        $vl_parcelas = $request->vl_parcelas;
        $dt_proposta = $request->dt_proposta;
        $dt_inicio = $request->dt_inicio;
        $ds_status = $request->ds_status;
        $data = new DateTime();
        $data = $data->format('Y-m-d H:i:s');
        $res = Db::update(
            'UPDATE propostas SET updated_at = :dt_update, ds_endereco = :ds_endereco,
            vl_total =:vl_total, vl_sinal = :vl_sinal, qt_parcelas = :qt_parcelas, 
            vl_parcelas = :vl_parcelas, dt_inicio_pagamento = :dt_inicio, 
            dt_proposta = :dt_proposta, ds_status = :ds_status
            WHERE id = :id',
            [
                'id' => $id_proposta,
                'dt_update' => $data, 'ds_endereco' => $nm_endereco_obra, 'vl_total' => $vl_total,
                'vl_sinal' => $vl_sinal, 'qt_parcelas' => $qt_parcelas, 'vl_parcelas' => $vl_parcelas,
                'dt_inicio' => $dt_inicio, 'dt_proposta' => $dt_proposta, 'ds_status' => $ds_status,

            ]
        );
        return $res;
    }
    static function delete_proposta($id)
    {
        $res = Db::delete(
            'DELETE FROM propostas WHERE id = :id',
            ['id' => $id]
        );
        return $res;
    }
}
