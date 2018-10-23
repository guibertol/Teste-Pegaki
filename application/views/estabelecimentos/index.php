<html>
    <head>
        
        <link rel="stylesheet" href="<?= base_url("css/bootstrap.css") ?>" />
        <title>Teste Guilherme Bertol</title>

        <style>
        
        body{
            background-color: #d2d6de;
        }

        .login-box, .register-box {
            width: 360px;
            margin: 7% auto;
        }

        .login-box-body, .register-box-body {
            background: #fff;
            padding: 20px;
            border-top: 0;
            color: #666;
        }

        .login-box-msg, .register-box-msg {
            margin: 0;
            text-align: center;
            padding: 0 20px 20px 20px;
        }

        .btn-success {
            margin-top: 10px;
        }

        .btn-info {
            margin-top: 10px;
        }

        .divespecial{
            width: 70%;
            margin: 7% auto;
        }

        </style>

        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" />
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script type="text/javascript" src="<?= base_url("js/jquery.mask.min") ?>" ></script>

    </head>

    <body>

        <div id="include"></div>
            
        <script>

            function padrao(){

            $('#cep').mask('00000-000');

            $(document).ready(function() {
                $('#table').DataTable({
                    "oLanguage":{
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                            "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                        },
                        "oAria": {
                            "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                        }
                    }
                });
            } );

            
            $(function(){
                $("#cep").blur(function(){
                    var cep = $('#cep').val();
                    if (cep == '') {
                        alert('Informe o CEP antes de continuar');
                        //$('#cep').focus();
                        return false;
                    }
                    $('#btn_consulta').html ('Aguarde...');
                    $.post('estabelecimentos/consulta',
                    {
                        cep : cep
                    }, 
                    function(dados){

                        if(dados.logradouro != null){
                            var endereco = dados.logradouro + ', ' + dados.bairro + ', ' + dados.localidade + ', ' + dados.uf;
                            $('#endereco').val(endereco);
                            console.log(dados);
                        }else{
                            alert('cep não localizado, por favor tente novamente');
                            $('#cep').val('');
                            $('#endereco').val('');
                        }

                        //$('#rua').val(dados.logradouro);
                        //$('#bairro').val(dados.bairro);
                        //$('#cidade').val(dados.localidade);
                        //$('#estado').val(dados.uf);
                        //$('#btn_consulta').html('Consultar');
                        
                    }, 'json');
                });
            });

            }

            function status_verificar(){

                var dados = {
                    token : '<?php echo $this->session->userdata("json_token"); ?>'
                }

                $.post('estabelecimentos/verificarToken', dados, function(retorno){
                    console.log(retorno);
                });

                
            }

            function login(){

                var email = $('#email').val();
                var senha = $('#senha').val();

                var dados = {
                    email : email,
                    senha : senha
                }

                $.post('login/autenticar', dados, function(retorno){

                    if(retorno != '0'){
                        assinar(retorno);
                        location.reload();
                    }else{
                        $('#erro_login').css('display', 'block');
                    }
                    
                });


            }

            function assinar(token){
                localStorage.setItem("token", token);
                return;
            }

            valor = '';
            function recuperar(){

                var token = localStorage.getItem("token");
                var variavel = '';
                
                if(token == '0' || localStorage.getItem("token") == null){

                    variavel = '0';

                }else{

                    var dados = {
                        token : token
                    }
                    
                    $.post('estabelecimentos/verificarToken', dados, function(retorno){
                    
                        if(retorno == '1'){
                            
                            $.post('estabelecimentos/viewLogado', '', function(retorno){
                                $('#include').html(retorno);
                                padrao();
                            });


                        }

                    });
                    
                }

                return valor;

            }

            function logout(){
                localStorage.clear();
                location.reload();

            }

            function verificar_login(){

                var valor = recuperar();

                if(valor == '1'){

                    
                }else{

                    $.post('estabelecimentos/viewNaoLogado', '', function(retorno){
                        $('#include').html(retorno);
                    });

                }

            }

            verificar_login();
            
            
        </script>

    </body>

</html>