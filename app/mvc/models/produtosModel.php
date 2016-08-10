<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class produtosModel extends Eloquent
{
	protected $table     = "produtos";
	protected $fillable  = ['codigobarras','descricao','nomefantasia','unidade','unidadeconversao','codigo_st','codigo_grupoproduto',
	'codigo_produtosefaz','codigo_tipoproduto','codigo_nbmsh','datacadastro','dataatualizacao','ultimavenda','aliquotaicms','aliquotaipi','aliquotaiss','estoque','estoqueregulador','precovenda','ultimocusto','precocompra','usuario','excluido','entradas','saidas','custoatual','datacustoatual','calculapis','calculacofins','alteracaogrupo','codigofabricante','ultimacompra','icmsoutros','acesso_contacredito','acesso_contadebito','tipoproduto','bloquearvendaestoquezerado','comissionado','arredondamentotruncamento','producaopropria','codigoestendido','codigotiposervico','md5','codigobarrasestendido','codigonaturezareceita','codigoanp','codigo_stentrada','unidadeentrada','codigo_sap','codigo_cest','codigo_desktop','empresa','updated_at','created_at'];
}

