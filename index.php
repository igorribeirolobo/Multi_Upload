<?php
require("upload.php");
    $upload = new Upload();
?>
        <?php
        if (isset($_POST['enviar'])) {
        
            //insere os dados do upload em um array.
            $upload->busca("filesToUpload", "name");
            $upload->busca("filesToUpload", "tmp_name");
            $upload->busca("filesToUpload", "size");

            //percorre o array, faz o upload e mostra a imagem.
            for ($i = 0; $i < count($_FILES["filesToUpload"]["name"]); $i++) {
                //retorna a situação do upload
                $upload->porcent($i,count($_FILES["filesToUpload"]["name"]));
                echo "<label>" . $upload->subir($i) . "</label>";

                
            }
        }
        //coloque as imagens já salvas do banco aqui!
        ?>
<!Doctype>
<html>
    <head>
    </head>
    <body>
        <form method="POST" action="index.php" id="formUpload" enctype="multipart/form-data">
            <input name="filesToUpload[]" id="filesToUpload" type="file" accept="image/*" multiple />
            <input type="submit"  name="enviar" id="btnEnviar"  value="enviar"/>
            <progress  value="<?php echo $upload->getResultado();?>" max="100"></progress><span id="porcentagem"><?php echo $upload->getResultado();?>%</span>
            <hr />
        </form> 
<?php
    for ($i = 0; $i < count($_FILES["filesToUpload"]["name"]); $i++) {
//retorna o caminho da imagem
                echo "<img src='" . $upload->getPath($i) . "' /><br />";
    }
?>
    </body>
</html>


