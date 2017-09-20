<?php
require("upload.php");
?>
<!Doctype>
<html>
    <head>
        <script src="jquery.js" type="text/javascript"></script>
        <script src="jquery.form.js" type="text/javascript"></script>
        <script src="upload.js" type="text/javascript"></script>
    </head>
    <body>
        <form method="POST" action="index.php" id="formUpload"  enctype="multipart/form-data">
            <input name="filesToUpload[]" id="filesToUpload" type="file" accept="image/*" multiple />
            <input type="submit" id="btnEnviar" name="enviar" value="enviar"/>
             <progress value="0" max="100"></progress><span id="porcentagem">0%</span>
            <hr />
        </form> 
        <?php
        if (isset($_POST['enviar'])) {
            $upload = new Upload();
            //insere os dados do upload em um array.
            $upload->busca("filesToUpload", "name");
            $upload->busca("filesToUpload", "tmp_name");
            $upload->busca("filesToUpload", "size");

            //percorre o array, faz o upload e mostra a imagem.
            for ($i = 0; $i < count($_FILES["filesToUpload"]["name"]); $i++) {
                //retorna a situação do upload
                echo $upload->subir($i);
              

                //retorna o caminho da imagem
                echo "<img src='" . $upload->getPath($i) . "' /><br />";
            }
        }
        //coloque as imagens já salvas do banco aqui!
        ?>
    </body>
</html>


