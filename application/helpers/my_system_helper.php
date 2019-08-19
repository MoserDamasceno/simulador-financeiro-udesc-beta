<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------

/**
 * Ação Direta System Helpers
 *
 * Customised singular and plural helpers.
 *
 * @package     CodeIgniter
 * @subpackage  Helpers
 * @category    Helpers
 * @author      Moser Damasceno
 */

// --------------------------------------------------------------------

/**
 * Função para exibir informações de uma determinada váriavel
 * @method pre
 * @author Moser Damasceno
 * @date   2015-03-03
 * @since  1.0.0
 * @access
 * @param  Mixed     $var  Variável que exibirá as informações
 * @param  boolean    $exit Se TRUE, mata o processo do sistema.
 * @return Void
 */
function pre($var, $exit = true, $dump = true)
{
	if ($dump) {
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}else{
		print_r($var);
	}
	
	if ($exit) {
		die();
	}

}

/**
 * Função para adicionar arquivo de JAVASCRIPT a determinada página
 * @method adicionarJavaScript
 * @author Moser Damasceno
 * @date   2015-03-03
 * @since  1.0.0
 * @access
 * @param  String              $arquivo nome/caminho do arquivo js a ser inserido no site. O arquivo deve estar dentro da pasta /assets/scripts/
 * @return Void
 */
function adicionarJavaScript($arquivo)
{
	$ci=& get_instance();
	$ci->config->load('config');
	$javascripts = $ci->config->item('javascripts');
	$javascripts[] = $arquivo;
	$ci->config->set_item('javascripts', $javascripts);
}

/**
 * Função para adicionar arquivo de CSS a determinada página
 * @method adicionarStyle
 * @author Moser Damasceno
 * @date   2015-03-03
 * @since  1.0.0
 * @access
 * @param  String              $arquivo nome/caminho do arquivo css a ser inserido no site. O arquivo deve estar dentro da pasta /assets/styles/
 * @return Void
 */
function adicionarStyle($arquivo)
{
	$ci=& get_instance();
	$ci->config->load('config');
	$styles = $ci->config->item('styles');
	$styles[] = $arquivo;
	$ci->config->set_item('styles', $styles);
}

/**
 * Função para adicionar uma BIBLIOTECA JS ou CSS de terceiros
 * @method adicionarLibrary
 * @author Moser Damasceno
 * @date   2015-03-03
 * @since  1.0.0
 * @access
 * @param  String           $nome    Nome da Biblioteca a ser importada. Deve ser o mesmo nome da pasta em /assets/libraries/
 * @param  Array           $arquivo Array com duas posições (javascript e style), e cada posição contém um array com os nomes de arquivos.
 *                                  Os arquivos JS devem estar em uma pasta chamada js dentro da biblioteca importada e o de CSS dentro da pasta
 *                                  css.
 * @return Void
 */
function adicionarLibrary($nome, $arquivo)
{
	$ci=& get_instance();
	$ci->config->load('config');
	$libraries = $ci->config->item('libraries');
	$libraries[$nome] = $arquivo;
	$ci->config->set_item('libraries', $libraries);
}

/**
 * Função para adicionar/alterar determinada Metatag
 * @method adicionarMetaTag
 * @author Moser Damasceno
 * @date   2015-03-03
 * @since  1.0.0
 * @access
 * @param  String           $metatag    nome da Metatag a ser alterada/adicionada
 * @param  String           $valor Valor a ser inserido na metatag
 * @return Void
 */
function adicionarMetaTag($metatag, $valor)
{
	$ci=& get_instance();
	$ci->config->load('config');
	$metatags = $ci->config->item('metatags');
	$metatags[$metatag] = $valor;
	$ci->config->set_item('metatags', $metatags);
}

/**
 * Retorna o link da pasta assets, que contém os arquivos de imagem, javascript, fontes e cs do site.
 * @method assets_url
 * @author Moser Damasceno
 * @date   2015-03-03
 * @since  1.0.0
 * @access
 * @return String     link da pasta assets
 */
function assets_url($url = '')
{
	return base_url() .'assets/' . $url;
}


/**
 * Retorna o link da pasta uploads, que contém os arquivos enviados pelo usuários.
 * @method uploads_url
 * @author Moser Damasceno
 * @date   2015-03-03
 * @since  1.0.0
 * @access
 * @return String     link da pasta uploads
 */
function uploads_url()
{
	return base_url() .'uploads/';
}
/**
 * Uploads directory
 * 
 */
function uploads_dir( $folder = '')
{
	return $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $folder;
}

/**
 * Função para adicionar/alterar determinada Canonical
 * @method adicionarCanonical
 * @author Alexander Rauber
 * @date   2015-03-11
 * @since  1.0.0
 * @access
 * @param  String           $valor Valor a ser inserido no canonical
 * @return Void
 */
function adicionarCanonical($valor)
{
	$ci=& get_instance();
	$ci->config->load('config');
	$ci->config->set_item('canonical', $valor);
}

function numbers($string)
{
	return preg_replace('/[^0-9]/', '', $string);
}

function array_except($array, ...$ignore)
{
	foreach ($ignore as $key) {
		unset($array[$key]);
	}

	return $array;
}

function array_split($array, $parts = 2)
{
	if ($parts < 2) {
		return [$array];
	}

	$count = ceil(count($array) / $parts);

	$slice = array_slice($array, 0, $count);

	return array_merge([$slice], array_split(array_slice($array, $count), $parts - 1));
}

function renderizarPagina($pagina, $data = null, $options = array())
{
	$ci=& get_instance();
	$ci->config->load('config');
	$library_template = $ci->config->item('library_template');

	$default = array(
		'template' => $ci->config->item('template'),
		'header' => 'header',
		'menu' => 'menu',
		'left-sidebar' => 'left-sidebar',
		'right-sidebar' => 'right-sidebar',
		'menu' => 'menu',
		'footer' => 'footer',
		'scripts' => 'scripts',
		);

	$configs = array_merge($default, $options);
	if(isset($library_template[$configs['template']])){
		adicionarLibrary( $configs['template'], $library_template[$configs['template']]);
	}

	if ($configs['header']) {
		$ci->load->view( 'templates/'.$configs['template'] . '/'.$configs['header'], $data );
	}

	if ($configs['menu']) {
		$ci->load->view( 'templates/'.$configs['template'] . '/'.$configs['menu'], $data );
	}

	if ($configs['left-sidebar']) {
		$ci->load->view( 'templates/'.$configs['template'] . '/'.$configs['left-sidebar'], $data );
	}

	$session = $ci->session->userdata();
	if (isset($session['message'])) {
		$ci->load->view( 'notifications/'.$session['type_message'], $session );
		$ci->session->unset_userdata(['type_message', 'message']);
	}

	$ci->load->view( 'templates/'.$configs['template'] . '/breadcrumb', $data );

	if (is_array($pagina)) {
		foreach ($pagina as $pag) {
			$ci->load->view( $pag , $data );
		}
	}else{
		$ci->load->view( $pagina , $data );
	}

	if ($configs['footer']) {
		$ci->load->view( 'templates/'.$configs['template'] . '/'.$configs['footer'], $data );
	}

	if ($configs['right-sidebar']) {
		$ci->load->view( 'templates/'.$configs['template'] . '/'.$configs['right-sidebar'], $data );
	}

	if ($configs['scripts']) {
		$ci->load->view( 'templates/'.$configs['template'] . '/'.$configs['scripts'], $data );
	}

}

function getPagseguroCredential()
{
	$ci=& get_instance();
	$config = $ci->config->item('pagseguro');
	\PagSeguro\Library::initialize();
	\PagSeguro\Library::cmsVersion()->setName('EBGE')->setRelease('1.0.0');
	\PagSeguro\Library::moduleVersion()->setName('EBGE')->setRelease('1.0.0');
	\PagSeguro\Configuration\Configure::setEnvironment($config['env']);
	\PagSeguro\Configuration\Configure::setAccountCredentials(
		$config['email'],
		$config['token']
	);

	return \PagSeguro\Configuration\Configure::getAccountCredentials();
}

function getPagseguroUrl($code)
{
	$ci=& get_instance();
	$env = $ci->config->item('pagseguro')['env'];

	if ($env == 'sandbox') {
		return 'https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $code;
	}
	
	return 'https://pagseguro.uol.com.br/v2/checkout/payment.html?code=' . $code;
}

function message($type, $message, $auth = false)
{
	$ci=& get_instance();
	$data = array(
		'type_message' => $type,
		'message' => $message,
		'message_auth' => $auth,
	);
	$ci->session->set_userdata($data);
}

function converterData($data, $output)
{
	if ($data) {
		switch ($output) {
			case 'mysql':
			$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
			return $data;
			case 'php':
			$data = date('d/m/Y', strtotime(str_replace('-', '/', $data)));
			return $data;
		}
	}
}

function converterDataInterface($data, $output)
{
	if ($data) {
		switch ($output) {
			case 'datahora':
				$data = date('Y-m-d', strtotime(str_replace('/', '-', $data)));
				return $data;
			case 'data':
				$data = date('d/m/Y', strtotime(str_replace('-', '/', $data)));
				return $data;
			case 'hora':
				$data = date('H:i', strtotime( $data));
				return $data;
		}
	}

}


function formatDate($date)
{
	if($date)
	{
		$dateFormat = date_create($date);
		$resultDateFormat = date_format($dateFormat, 'd/m/Y - H:i');
	}
	return $resultDateFormat;
}

function converterMoeda($valor, $direction = 'interface')
{
	switch ($direction) {
		case 'interface':
			if (is_numeric($valor)) {
				$valor = number_format($valor, 2, ',', '.');
			}
			return $valor;
		
		case 'mysql':
			$valor = str_replace('.', '', $valor);
			$valor = str_replace(',', '.', $valor);
			return $valor;
	}
}

function diferencaData($data, $data2)
{
	$datetime1 = date_create($data);
	$datetime2 = date_create($data2);
	$interval = date_diff($datetime1, $datetime2);
	return $interval->format('%R%i');
}

function slugify($text) {
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	$text = trim($text, '-');
	$text = preg_replace('~-+~', '-', $text);
	$text = strtolower($text);
	if (empty($text)) {
		return 'n-a';
	}
	return $text;
}

function normalizeText($text)
{
	return preg_replace('/[^A-Za-z0-9\-]/', '', utf8_encode(slugify($text)));
}

function removeqsvar($url, $varname) {
    $url = preg_replace('/([?&])'.$varname.'=[^&]+(&|$)/','$1',$url);
    if (substr($url, -1, 1) == '&') {
    	$url = substr($url, 0, -1);
    }
    
    return $url;
}


/* End of file MY_system_helper.php */
/* Location: ./application/helpers/MY_system_helper.php */


