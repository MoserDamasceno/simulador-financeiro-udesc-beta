<script>
    var base_url = function (url) {
        if (typeof url == 'undefined') {
            url = '';
        };
        return '<?php echo base_url("'+url+'"); ?>';
    }
</script>
<!-- Declaração dos arquivos de JAVASCRIPTS das bibliotecas importadas  -->
<?php 
foreach ($this->config->item('libraries') as $library => $types) {
    foreach ($types as $type => $values) {
        if ($type == 'javascript') {
            foreach ($values as $value) {
                if (substr($value, 0,4) == 'http' || substr($value, 0,2) == '//' ) {
                    echo '<script src="'.$value .'"></script>'.PHP_EOL;
                }else{
                    echo '<script src="'.assets_url().'libraries/'.$library.'/js/'. $value .'"></script>'.PHP_EOL;
                }
            }
        }
    }
}
?>

<!-- Declaração dos arquivos de JAVASCRIPT -->
<?php foreach ($this->config->item('javascripts') as $value): ?>
    <script src="<?php echo assets_url() .'scripts/'.$value ?>"></script>
<?php endforeach ?>

</body>
</html>
