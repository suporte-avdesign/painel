<?php
use Illuminate\Contracts\Filesystem\Factory as fileFactory ;
use Illuminate\Support\Facades\Storage as Storage;


/**
 * Criar arquivo txt dos acessos dos usuário administrativos.
 *
 * @var string str
 * @return  void
 */
if (! function_exists('generateAccessesTxt')) {
	function generateAccessesTxt($str){
		$factory = app(fileFactory::class);		
		$admin   = auth()->guard('admin')->user();
		$path    = 'Accesses/'.$admin->id.'/'.date('d-m-Y').'.txt'; 

		$diskAccesses = $factory->disk('local');
		if ($diskAccesses->exists($path)) {
			$diskAccesses->append($path, $str); 
		} else {
			$diskAccesses->put($path, $str);
		}

	}
}

/**
 * Lista os acessos dos usuário administrativos.
 *
 * @var int $id user
 * @return files txt
 */
if (! function_exists('listAccessTxt')) {
	function listAccessTxt($id){
		$factory = app(fileFactory::class);
		$path    = 'Accesses/'.$id;			
		$files   = $factory->allFiles($path);
		rsort($files);
		return $files;
	}
}


/**
 * $ac: abrir, excluir e excluir-todos os arquivos.
 * $path: Caminho relativo do arquivo.
 * $nome: Nome do usuário.
 * $dir: Dieretorio gravação do arquivo.
 * @var  string $ac string $path string $nome string $dir
 */

if (! function_exists('actionsTxt')) {
	function actionsTxt($ac, $path, $name, $id){
		$factory = app(fileFactory::class);
		$exists  = $factory->exists($path);
		if ($ac == 'delete-all') {
			$acao = $factory->deleteDirectory($path, $preserve = false);
			generateAccessesTxt(date('H:i:s').' Excluiu todos os arquivos de acessos de '.$name);
			$success = true;
			$message = 'Os arquivos dos acessos foram exluidas.';
		} else {
			if ($exists) {
				if ($ac == 'open') {

					$str  = substr($path, -14);
					$date = substr($str, 0, 10);
					$text = nl2br(utf8_encode($factory->get($path)));
					print('<h5 class="anthracite underline">'.$name.' - Data: '.$date.'</h5>');
					print(nl2br($text));
					$success=''; 
					$message='';
				} elseif ($ac == 'delete') {
					$acao = $factory->delete($path);
					$file = substr($path, -14);
					generateAccessesTxt(date('H:i:s').' Excluiu o arquivo de acesso: '.$file.' de '.$name);
					$success = true;
					$message = "O arquivo {$file} foi exluido.";
				}
			} else {
				$success = false;
				$message = 'Este arquivo não existe.';
			}
		}

        $out = array(
            "success" => $success,
            "message" => $message
        );

		return $out;
	}	
}

