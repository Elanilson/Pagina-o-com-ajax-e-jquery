
$(document).ready( ()=>{ // carregar depois que tudo tiver carregado

		let url = 'https://jsonplaceholder.typicode.com/posts'
		let xmlHttp = new XMLHttpRequest()
		xmlHttp.open('GET',url)
		xmlHttp.onreadystatechange = () =>{
			if(xmlHttp.readyState === 4  && xmlHttp.status == 200){
				let dadosJsonText = xmlHttp.responseText
				let dadosJson = JSON.parse(dadosJsonText)
				let postPorPagina = 10
				let totalDePaginas = dadosJson.length / postPorPagina

		//	console.log('totoal de página '+totalDePaginas)
				//cria as numerações das páginas
			for(let x=totalDePaginas ;x >= 1 ; x--){
		
			//	console.log('pagina '+x)
				$('#paginaItem').after(`<li class="page-item  "><a href="" class="page-link " id="pagina${x}">${x}</a></li>`)
				
				//criando o evento de click
				$(`#pagina${x}`).on('click',(e)=>{
					e.preventDefault() // tirando o evento de reflesh 
						$('#column-conteudo').html("")
						loadingGif()

					let pagina = $(`#pagina${x}`).html() // recebendo o conteudo 
					//document.getElementById(`#pagina${x}`).style ='background: red;'
				
				//	console.log('valor: '+pagina)
					$.ajax({
						type: 'GET',
						url: 'postagem_Controller.php',
						data: `pagina=${pagina}`,
						dataType: 'json',
						success: dados => {
							document.getElementById('loading').remove()
							console.log(dados)
							for(let x in dados){

							$('#column-conteudo').append(`<div class="card bg-dark text-white " style="box-shadow: 5px 5px 5px black;">       <div class="card-header">         Postagem Nº ${dados[x].id}       </div>       <div class="card-body" >         <h4 id="idteste" class="card-title">${dados[x].title}</h4>         <br>         <h6 class="card-subtitle">Subtítulo do cartão</h6>         <br>         <p id="idteste" class="card-text">${dados[x].body}</p>        <button class="btn btn-info"  data-toggle="modal" data-target="#exampleModalCenter" onclick="">Salva no banco </button>       </div>     </div>`)
							}
							
							/*console.log(dados.userId)
							console.log(dados.id)
							console.log(dados.title)
							console.log(dados.body)*/

						},
						error: erro => {console.log(erro)}
					})

				})
			}
			carregarConteudo()
		}//fim
	}//fim

	
	xmlHttp.send()


} // fim $(document).ready
)

	function carregarConteudo(){
		loadingGif()
		$.ajax({
						type: 'GET',
						url: 'postagem_Controller.php',
						data: `pagina=${1}`,
						dataType: 'json',
						success: dados => {
							document.getElementById('loading').remove()
							for(let x in dados){

							$('#column-conteudo').append(`<div class="card bg-dark text-white " style="box-shadow: 5px 5px 5px black;">       <div class="card-header">         Postagem Nº ${dados[x].id}       </div>       <div class="card-body" >         <h4 id="idteste" class="card-title">${dados[x].title}</h4>         <br>         <h6 class="card-subtitle">Subtítulo do cartão</h6>         <br>         <p id="idteste" class="card-text">${dados[x].body}</p>        <button class="btn btn-info"  data-toggle="modal" data-target="#exampleModalCenter" onclick="${capturandoDadosPostagem(dados[x].id,dados[x].title,dados[x].body)}">Salva no banco </button>       </div>     </div>`)
							}
						
						},
						error: erro => {console.log(erro)}
					})

	}

function loadingGif(){

				//incluir o gif de loading na pagina
				if(!document.getElementById('loading')){
				let imgLoad = document.createElement('img')
				imgLoad.id = 'loading'
				imgLoad.src = 'loading.gif'
				imgLoad.className = 'rounded mx-auto d-block'
				

				document.getElementById('column-conteudo').appendChild(imgLoad);
				}
}

function capturandoDadosPostagem(id,titulo,texto){
	$("#idPostagem").html(id)
	$("#idTitulo").html(titulo)
	$("#idTexto").html(texto)

}
function salvar(){
	$.ajax({
		type: 'POST',
		url: 'postagem_Controller.php',
		data: `id=${1},titulo=${"titulo"},texto=${"texto"}`,
		success: data =>{console.log("dados +> :"+data+"fimmmmmmm")},
		error: erro =>{console.log(erro)}
	})
}

