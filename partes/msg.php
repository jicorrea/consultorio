
<?php 
    $msj=str_replace("%", " ",$_GET['msj']);

    echo "<div class='modal fade' data-backdrop='static' data-keyboard='false' tabindex='-1' id='completeModal' role='dialog'>
            <div class='modal-dialog modal-sm'>
                <div class='modal-content'>
                    <div class='modal-header' style='";
                        switch ($_GET['titulo']) {
                            case 'Error':
                                echo 'background-color:red;';
                                # code...
                                break;
                            case 'Registro':
                                echo 'background-color:green;';
                                break;
                            case 'Modificacion':
                                echo 'background-color:blue;';
                                break;    
                            case 'Realizado':
                                echo 'background-color: #66a3ff;'; 
                                break;                               
                            default:
                                # code...
                                break;
                        }
                        echo "'>
                        <h4 class='modal-title' style='color: white;'><center><span class='".(($_GET['titulo']=='Error')?'glyphicon glyphicon-ban-circle':'glyphicon glyphicon-ok-circle')."'style='font-size:150%;'></span>".'  '.$_GET['titulo']."</center></h4>
                    </div>
                    <div class='modal-body'>
                        <p class='text-center'>".$msj."</p>  
                    </div>
                    <div class='modal-footer'>                    
                    </div>
                </div>
            </div>
        </div>";
    echo "<script>
    $('#completeModal').modal(); setTimeout(function(){ location.href = 'index.html'; }, 3000);

    </script>";
?>