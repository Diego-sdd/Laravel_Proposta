<?php

namespace App;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use NunoMaduro\Collision\Adapters\Phpunit\Timer;

class ModelCliente extends Model
{
    static function Create(Request $request)
    {
        $id = auth()->user()->id;
        $razao_s = $request->razao_social;
        $nome_f = $request->nome_fantasia;
        $cnpj = $request->cnpj;
        $endereco = $request->endereco;
        $email = $request->email;
        $telefone = $request->telefone;
        $celular = $request->celular;
        $responsavel = $request->responsavel;
        $cpf = $request->cpf;
        $data = new DateTime();
        $data = $data->format('Y-m-d H:i:s');

        $valor = Db::insert(
            'INSERT INTO `db_marca_site`.`cliente`
            (nm_razao,nm_fantasia,cd_cnpj,ds_endereco,ds_email,cd_telefone,cd_celular, 
            nm_responsavel,cd_cpf,created_at,updated_at,id_user)
            VALUES (:razao_s,:nome_f,:cnpj,:endereco,:email,:telefone,:celular, 
                :responsavel,:cpf,:datacreat,:dataupd,:id )',
            [
                'razao_s' => $razao_s,
                'nome_f' => $nome_f,
                'cnpj' => $cnpj,
                'endereco' => $endereco,
                'email' => $email,
                'telefone' => $telefone,
                'celular' => $celular,
                'responsavel' => $responsavel,
                'cpf' => $cpf,
                'datacreat' => $data,
                'dataupd' => $data,
                'id' => $id,
            ]
        );

        return ($valor);
    }
    static function select_cliente()
    {
        $id = auth()->user()->id;
        $clientes = Db::select(
            'SELECT * FROM cliente where id_user = :id',
            ['id' => $id]
        );
        return $clientes;
    }
    static function update_cliente(Request $request)
    {

        $id_cliente = $request->id_cliente;
        $razao_s = $request->razao_social;
        $nome_f = $request->nome_fantasia;
        $cnpj = $request->cnpj;
        $endereco = $request->endereco;
        $email = $request->email;
        $telefone = $request->telefone;
        $celular = $request->celular;
        $responsavel = $request->responsavel;
        $cpf = $request->cpf;
        $data = new DateTime();
        $data = $data->format('Y-m-d H:i:s');
        $res = Db::update(
            'UPDATE cliente SET nm_razao = :nm_razao, nm_fantasia = :nm_fantasia,
            cd_cnpj = :cd_cnpj, ds_endereco = :ds_endereco, ds_email = :ds_email,
            cd_telefone = :cd_telefone, cd_celular = :cd_celular, nm_responsavel = :nm_responsavel,
            cd_cpf = :cd_cpf, updated_at = :updated_at
            WHERE id = :id',
            [
                'id' => $id_cliente,
                'nm_razao' => $razao_s, 'nm_fantasia' => $nome_f, 'cd_cnpj' => $cnpj,
                'ds_endereco' => $endereco, 'ds_email' => $email, 'cd_telefone' => $telefone,
                'cd_celular' => $celular, 'nm_responsavel' => $responsavel, 'cd_cpf' => $cpf,
                'updated_at' => $data
            ]
        );
        return $res;
    }
    static function select_edit($id)
    {
        $res = Db::select(
            'SELECT * FROM db_marca_site.cliente where id = :id',
            ['id' => $id]
        );
        return $res;
    }
    static function valida_create(Request $request)
    {
        $id = auth()->user()->id;
        $nm_razao = $request->razao_social;
        $nm_fantasia = $request->nome_fantasia;
        $cd_cnpj = $request->cnpj;
        $res = Db::select(
            'SELECT nm_razao,  nm_fantasia, cd_cnpj FROM cliente where
            (nm_razao = :nm_razao || nm_fantasia = :nm_fantasia ||
            cd_cnpj = :cd_cnpj) and id_user = :id',
            [
                'id' => $id,
                'nm_razao' => $nm_razao,
                'nm_fantasia' => $nm_fantasia,
                'cd_cnpj' => $cd_cnpj
            ]
        );

        return $res;
    }
}
