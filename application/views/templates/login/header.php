<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<link rel="icon" type="image/png" href="<?php echo assets_url() ?>images/favicon/favico.png">
	<meta name="msapplication-TileColor" content="#ffff00">
	<meta name="msapplication-TileImage" content="<?php echo assets_url() ?>images/favicon/favicon.png">
	<meta name="theme-color" content="#ffff00">
	<!-- Declaração das metatags -->
	<?php foreach ($this->config->item('metatags') as $tag => $value): ?>
		<meta name="<?php echo $tag ?>" content="<?php echo $value ?>"/>
	<?php endforeach ?>
	<link rel="canonical" href="<?php echo $this->config->item('canonical'); ?>" />

	<!-- Declaração do título da página -->
	<title><?php echo $title . ' - ' . $this->config->item('titulo_projeto') ?></title>

	<!-- Declaração dos arquivos de ESTILO das bibliotecas importadas  -->
	<?php
	foreach ($this->config->item('libraries') as $library => $types) {
		foreach ($types as $type => $values) {
			if ($type == 'style') {
				foreach ($values as $value) {
					if (substr($value, 0,4) == 'http' || substr($value, 0,2) == '//' ) {
						echo '<link href="'. $value .'" type="text/css" rel="stylesheet" media="all"/>' . PHP_EOL;
					}else{
						echo '<link href="'.assets_url().'libraries/'.$library.'/css/'. $value .'" type="text/css" rel="stylesheet" media="all"/>' . PHP_EOL;
					}
				}
			}
		}
	}
	?>

	<!-- Declaração dos arquivos de ESTILO -->
	<?php foreach ($this->config->item('styles') as $value): ?>
		<link href="<?php echo assets_url() . 'styles/'.$value ?>" type="text/css" rel="stylesheet"  media="all"/>
	<?php endforeach ?>
	
</head>
<body id="app" class="login-page">
	
