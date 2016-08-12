<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class clientesModel extends Eloquent
{
	protected $table     = "clientes";
	protected $fillable  = ['id','nome','estado','cnpj','inscricaoestadual','contato','email','observacao','datacadastro','usuario','tipopessoa','numero_grupo','razaosocial','contato2','datanascimento','excluido','matriz','site','mesclado','numero_grupofaturamento','inscricaomunicipal','msgnotafiscal','msgboleto','alteracaogrupo','imprimirboleto','imprimirnotafiscal','boletoindividual','numero_condpgto','regiao_atendimento','acesso_contacredito','acesso_contadebito','id_limitechequeemitente','id_limitechequeportador','id_limitecredito','id_limitecartafrete','id_limitevalemotorista','limiteproduto','observacaofrentecaixa','notareferenteobrigatoria','liberaalteracaodadoscupom','tipospagamentosliberados','camposadicionaiscupom','condicaopagamentovenda','mensagemnotareferente','mensagemcupomfiscal','imagem','solicitarequisicao','numero_classenegociacao','bloqueado','aceitavalemotorista','dataultimavenda','codigoretaguarda','bloqueioautomatico','tipobloqueioantecipado','numero_desktop','empresa','created_at','updated_at'
	];
}

