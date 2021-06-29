<?php
	require "../../postagem/conexao.php";
	require "../../postagem/postagem_Model.php";
	require "../../postagem/postagem_Service.php";

	class Postag{
		public $userId;
		public $id;
		public $title;
		public $body;


		public function __get($atributo) {
		return $this->$atributo;
	}

	public function __set($atributo, $valor) {
		$this->$atributo = $valor;
		return $this;
	}

	}




	//-------------------------------
	//consumindo api
	$url = "https://jsonplaceholder.typicode.com/posts";
	//$url = "https://viacep.com.br/ws/01001000/json/";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
	$posts = json_decode(curl_exec($ch));
	//metodo para receber o tamanho do array
	$tamanhoDoArrayApi = count($posts);
	//descobrir quantas paginas vão ter apartir do numero de elemento que quer se seja exibido
	$totalDePaginasApi = $tamanhoDoArrayApi / 10;
	$paginaAtualApi = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	$deslocamentoApi = ($paginaAtualApi ) * $totalDePaginasApi;
	$controle = 10*$paginaAtualApi;
	$postApi = array();
		$postagemm = new Postag();
		$postt = array();
		
	 	for ($i=0; $i <=$tamanhoDoArrayApi ; $i++) { 
		if($deslocamentoApi == 0 || $deslocamentoApi == 10 ){
			if($i <= 9){
				$postApi[$i] = $posts[$i];
				
					$postagemm->__set('userId',$posts[$i]->userId);
					$postagemm->__set('id',$posts[$i]->id);
					$postagemm->__set('title',$posts[$i]->title);
					$postagemm->__set('body',$posts[$i]->body);
					
					$postt[$i] = ['userId'=> $posts[$i]->userId,'id'=>$posts[$i]->id,'title'=>$posts[$i]->title,'body'=>$posts[$i]->body];


			}
		}else if($i >= $controle-10 && $i<$controle){
			$postagemm->__set('userId',$posts[$i]->userId);
					$postagemm->__set('id',$posts[$i]->id);
					$postagemm->__set('title',$posts[$i]->title);
					$postagemm->__set('body',$posts[$i]->body);

				$postt[$i] = ['userId'=> $posts[$i]->userId,'id'=>$posts[$i]->id,'title'=>$posts[$i]->title,'body'=>$posts[$i]->body];
				
			

		}
		
		
	
	 	}


		echo json_encode ($postt);



	/*
	echo'<pre>';
	print_r($postApi);
	echo '</pre>';
	
	echo'<pre>';
	print_r('numero de pagina '.$controle);
	echo '</pre>';
*/

	
	
		
	
	


	


	
	//echo$totalDePaginas;
	/*
	$listaDePaginas = [];
	$indice =0;
	for($n=1; $n <=$tamahoDoArray; $n++){
		
		$indice = $indice <= $n; $indice :

		if($indice ==){
			$listaDePaginas = $posts;

		}
	}
	

	echo'<pre>';
	print_r($listaDePaginas);
	echo '</pre>';
	echo'<pre>';
	//print_r($listaa);
	echo '</pre>';
*/

/*
echo'<pre>';
print_r ($variavel[0]->body);
echo '</pre>';

echo'<pre>';
print_r($_POST);
echo '</pre>'; */

/*
	$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

	$totalRegistroPagina = 10;
	
	$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
	$deslocamento = ($pagina - 1) * $totalRegistroPagina;


	if($_POST != null){
		$postagem = new Postagem();
		$postagem->__set('id',$_POST['id']);
		$postagem->__set('titulo',$_POST['titulo']);
		$postagem->__set('texto',$_POST['texto']);

		$conexao = new Conexao();

		$service = new PostagemService($conexao,$postagem);
		$service->salvar();


		

}else if($acao =='remover'){
	$postagem = new Postagem();

	$postagem->__set('id',$_GET['id']);

	$conexao = new Conexao();

	$service = new PostagemService($conexao,$postagem);
	$service->remover();
	header('location: listagem.php');

	


}else{
	$postagem = new Postagem();
	$conexao = new Conexao(); 
	$service = new PostagemService($conexao,$postagem);
	$postagem = $service->listarPorPagina($totalRegistroPagina,$deslocamento);
	$totalRegitro = $service->totalRegistro();
	$total_de_pagina = ceil($totalRegitro['total'] / 10);
	$paginaAtiva = $pagina;
	//print_r($total_de_pagina);

}



	if($acao == 'salvar'){
		$postagem = new Postagem();
		$postagem->__set('id',$_POST['id']);
		$postagem->__set('titulo',$_POST['titulo']);
		$postagem->__set('texto',$_POST['texto']);

		$conexao = new Conexao();

		$service = new PostagemService($conexao,$postagem);

		$service->salvar();

	}else if($acao == 'listar'){
	$postagem = new Postagem();
	$conexao = new Conexao(); 
	$service = new PostagemService($conexao,$postagem);

}
*/

?>