<?php
/**
 * Created by PhpStorm.
 * User: kelver
 * Date: 04/06/17
 * Time: 15:59
 */
use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        '/admin/Plantas', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $repositoryPlantas = $app->service('plantas.repository');
            $plantas = $repositoryPlantas->all();

            return $view->render(
                '/admin/Plantas/list.html.twig', [
                    'plantas' => $plantas,
                    'menu' => 'plantas'
                ]
            );
        }, 'admin.plantas.list'
    )
    ->get(
        '/admin/Plantas/', function () use ($app) {
            return $app->route('admin.plantas.list');
        }, 'admin.plantas.redirect'
    )
    ->get(
        '/admin/Plantas/new', function () use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');

            $repositoryEspecie = $app->service('especies.repository');
            $especies = $repositoryEspecie->all();
            $repositoryCategoria = $app->service('categorias.repository');
            $categorias = $repositoryCategoria->all();
            $repositoryContinente = $app->service('continentes.repository');
            $continentes = $repositoryContinente->all();
            $repositoryGenero = $app->service('generos.repository');
            $generos = $repositoryGenero->all();
            $repositoryOrigem = $app->service('origens.repository');
            $origens = $repositoryOrigem->all();
            $repositoryPais = $app->service('paises.repository');
            $paises = $repositoryPais->all();
            $repositoryTipoFolha = $app->service('tipoFolha.repository');
            $tipoFolha = $repositoryTipoFolha->all();
            $repositoryEstados = $app->service('estados.repository');
            $estados = $repositoryEstados->all();
            $repositoryRegioes = $app->service('regioes.repository');
            $regioes = $repositoryRegioes->all();
            $repositoryCaracteresFolha = $app->service('caracteres.repository');
            $caracteresFolha = $repositoryCaracteresFolha->findByField('tipo', 0);
            $repositoryCaracteresCasca = $app->service('caracteres.repository');
            $caracteresCasca = $repositoryCaracteresFolha->findByField('tipo', 1);



            $repository= $app->service('plantas.repository');

            return $view->render(
                '/admin/Plantas/new.html.twig', [
                    'especies' => $especies,
                    'categorias' => $categorias,
                    'continentes' => $continentes,
                    'generos' => $generos,
                    'origens' => $origens,
                    'paises' => $paises,
                    'tipoFolha' => $tipoFolha,
                    'estados' => $estados,
                    'regioes' => $regioes,
                    'caracteresFolha' => $caracteresFolha,
                    'caracteresCasca' => $caracteresCasca,
                    'menu' => 'plantas'
                ]
            );
        }, 'admin.plantas.new'
    )
    ->post(
        '/admin/Plantas/store', function (ServerRequestInterface $request) use ($app) {
            $data = $request->getParsedBody();
            $data['status'] = 1;
            $data['genero'] = 1;
            $data['unidade_altura'] = 'mt';

            //Cadastra Planta
            $repository = $app->service('plantas.repository');
            $plantaInserida = $repository->create($data);
            //Atribui id da planta inserida
            $data['id_plantas'] = $plantaInserida->id;

            //cadastra estados
            foreach($data['estado'] as $estado){
                $data['id_estado'] = $estado;
                $repositoryPlantasEstados = $app->service('plantasEstados.repository');
                $repositoryPlantasEstados->create($data);
            }

            //cadastra continentes
            foreach($data['continente'] as $continente){
                $data['id_continente'] = $continente;
                $repositoryPlantasContinentes = $app->service('plantasContinentes.repository');
                $repositoryPlantasContinentes->create($data);
            }

            //cadastra paises
            foreach($data['pais'] as $pais){
                $data['id_pais'] = $pais;
                $repositoryPlantasPaises = $app->service('plantasPaises.repository');
                $repositoryPlantasPaises->create($data);
            }

            //cadastra regioes
            foreach($data['regiao'] as $regiao){
                $data['id_regiao'] = $regiao;
                $repositoryPlantasRegioes = $app->service('plantasRegioes.repository');
                $repositoryPlantasRegioes->create($data);
            }

            //cadastra categorias
            foreach($data['categorias'] as $categoria){
                $data['id_categoria'] = $categoria;
                $repositoryPlantasCategorias = $app->service('plantasCategorias.repository');
                $repositoryPlantasCategorias->create($data);
            }

            //cadastra caracteres folha
            foreach($data['caracteres_especiais_folha'] as $caracteresFolha){
                $data['id_caracteres_especiais'] = $caracteresFolha;
                $repositoryCaracteresFolhas = $app->service('plantasCaracteres.repository');
                $repositoryCaracteresFolhas->create($data);
            }

            //cadastra caracteres casca
            foreach($data['caracteres_especiais_casca'] as $caracteresCasca){
                $data['id_caracteres_especiais'] = $caracteresCasca;
                $repositoryCaracteresCasca = $app->service('plantasCaracteres.repository');
                $repositoryCaracteresCasca->create($data);
            }

            return $app->route('admin.plantas.create', ['idPlanta' => $data['id_plantas']]);
        }, 'admin.plantas.store'
    )
    ->get(
        '/admin/Plantas/create/{idPlanta}', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $idPlanta = $request->getAttribute('idPlanta');

            return $view->render(
                '/admin/Plantas/create.html.twig', [
                    'idPlanta' => $idPlanta,
                    'menu' => 'plantas'
                ]
            );
        }, 'admin.plantas.create'
    )
    ->post(
        '/admin/Plantas/finishAdd', function (ServerRequestInterface $request) use ($app) {
        $data = $request->getParsedBody();
        $data['id_plantas'] = $data['plantaId'];
        $data['status'] = 1;
	
	    print_r("<pre>");
	    print_r($data);
	    //cadastra referencia planta
	    for($i = 0; $i<count($data['ref']['texto']); $i++){
		    $data['texto'] = $data['ref']['texto'][$i];
		    $data['link'] = $data['ref']['link'][$i];
		    $repositoryReferencia = $app->service('referencias.repository');
		    $repositoryReferencia->create($data);
	    }
	
	    //cadastra videos planta
	    for($i = 0; $i<count($data['video']['texto']); $i++){
		    $data['legenda'] = $data['video']['texto'][$i];
		    $data['video'] = $data['video']['url'][$i];
		    $repositoryVideos = $app->service('videos.repository');
		    $repositoryVideos->create($data);
	    }
	
	    //cadastra mapeamento planta
	    for($i = 0; $i<count($data['map']['font']); $i++){
		    $data['latitude'] = $data['map']['latitude'][$i];
		    $data['longitude'] = $data['map']['longitude'][$i];
		    $data['fonte'] = $data['map']['font'][$i];
		    $repositoryMap = $app->service('map.repository');
		    $repositoryMap->create($data);
	    }
	
        return $app->route('admin.plantas.list');
    }, 'admin.plantas.storeFinal'
    )
    ->get(
        '/admin/Plantas/{id}/edit', function (ServerRequestInterface $request) use ($app) {
            $view = $app->service('view.renderer');
            $auth = $app->service('auth');
            $id = $request->getAttribute('id');
            $repositoryCadastro = $app->service('user.repository');
            $plantas = $repositoryCadastro->findOneBy(
                ['id' => $id]
            );
            return $view->render(
                '/admin/Plantas/edit.html.twig', [
                    'plantas' => $plantas,
                    'menu' => 'plantas'
                ]
            );
        }, 'admin.plantas.edit'
    )
    ->post(
        '/admin/Plantas/{id}/update', function (ServerRequestInterface $request) use ($app) {
            $auth = $app->service('auth');
            $repositoryPessoa = $app->service('pessoa.repository');
            $repositoryCadastro = $app->service('user.repository');
            $idCadastro = $request->getAttribute('id');
            $idPessoa = $repositoryCadastro->find($idCadastro)['attributes']['pessoa_id'];
            $data = $request->getParsedBody();
            $dataPessoa = ['nome' => $data['nome'], 'email' => $data['email'], 'telefone' => $data['telefone']];
            $dataCadastro = ['usuario' => $data['usuario']];
            $data['senha'] != '' ? $dataCadastro = ['senha' => $auth->hashPassword($data['senha'])] : '';

            $repositoryCadastro->update($idCadastro, $dataCadastro);

            $repositoryPessoa->update($idPessoa, $dataPessoa);
            return $app->route('admin.plantas.list');
        }, 'admin.plantas.update'
    )
    ->get(
        '/admin/Plantas/{id}/status/{status}', function (ServerRequestInterface $request) use ($app) {
            $auth = $app->service('auth');
            $repositoryCadastro = $app->service('user.repository');
            $idCadastro = $request->getAttribute('id');
            $dataStatus = ['status' => $request->getAttribute('status')];
            $repositoryCadastro->update($idCadastro, $dataStatus);

            return $app->route('admin.plantas.list');
        }, 'admin.plantas.status'
    );