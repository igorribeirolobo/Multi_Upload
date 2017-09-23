$(document).ready(function(){
    $('#btnEnviar').click(function(){
        $('#formUpload').ajaxForm({
            uploadProgress: function(percentComplete) {
                $('progress').attr('value',percentComplete);
                $('#porcentagem').html(percentComplete+'%');
            },        
            success: function(data) {
                $('progress').attr('value','100');
                $('#porcentagem').html('100%'); 
                data.sucesso = true;
                if(data.sucesso == true){
                    $('#resposta').html('<img src="'+ data.msg +'" />');
                }
                else{
                    $('#resposta').html(data.msg);
                }                
            },
            
            dataType: 'json',
            url: 'index.php',
            resetForm: true
        }).submit();
    })
})