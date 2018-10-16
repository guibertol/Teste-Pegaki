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
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" /></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" /></script>


    </head>

    <body>

        <?php if($this->session->flashdata("success")){ ?>
            <p class="alert alert-success"><?= $this->session->flashdata("success") ?></p>
        <?php } ?>

        <?php if($this->session->flashdata("danger")){ ?>
            <p class="alert alert-danger"><?= $this->session->flashdata("danger") ?></p>
        <?php } ?>

        <?php if($this->session->userdata("usuario_logado")){ ?>
            <div class="divespecial login-box-body" style="background-color: #FFF;">
                <h1>Estabelecimentos</h1>
                <table id="table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Endereço</th>
                            <th>CEP</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($estabelecimentos as $estabelecimento){ ?>
                            <tr>
                                <td><?= $estabelecimento['nome']; ?></td>
                                <td><?= $estabelecimento['endereco']; ?></td>
                                <td><?= $estabelecimento['cep']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <h1>Cadastro de estabelecimentos</h1>
                <?php 
                
                    echo form_open("estabelecimentos/novo");

                    echo form_label("Nome", "nome");

                    echo form_input(array(
                        "name" => "nome",
                        "id" => "nome",
                        "class" => "form-control"
                    ));

                    echo form_label("CEP", "cep");

                    echo form_input(array(
                        "name" => "cep",
                        "id" => "cep",
                        "class" => "form-control"
                    ));

                    echo form_label("Endereço", "endereco");

                    echo form_input(array(
                        "name" => "endereco",
                        "id" => "endereco",
                        "class" => "form-control"
                    ));

                    echo form_button(array(
                        "class" => "btn btn-success",
                        "type" => "submit",
                        "content" => "Cadastrar"
                    ));

                    echo form_close();

                ?>
            </div>
        <?php } ?>

        <?php if(!$this->session->userdata("usuario_logado")){ ?>
        
        <div class="login-box">
            <div class="login-box-body">
                <p class="login-box-msg">Iniciar Sessão</p>
                <?php 
                
                    echo form_open("login/autenticar");

                    echo form_label("E-mail", "email");

                    echo form_input(array(
                        "name" => "email",
                        "id" => "email",
                        "class" => "form-control"
                    ));

                    echo form_label("Senha", "senha");

                    echo form_input(array(
                        "name" => "senha",
                        "id" => "senha",
                        "class" => "form-control"
                    ));

                    echo form_button(array(
                        "class" => "btn btn-info",
                        "type" => "submit",
                        "content" => "Login"
                    ));

                    echo form_close();

                ?>
            </div>
        </div>
        
        <?php }else{ ?>
            <div class="login-box" style="width: 0px;"><?= anchor("login/logout", "Sair", array("class" => "btn btn-info")) ?></div>
        <?php } ?>

        
            
        <script>

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

        </script>

        <script>
            
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
                        //$('#rua').val(dados.logradouro);
                        //$('#bairro').val(dados.bairro);
                        //$('#cidade').val(dados.localidade);
                        //$('#estado').val(dados.uf);
                        //$('#btn_consulta').html('Consultar');
                        var endereco = dados.logradouro + ', ' + dados.bairro + ', ' + dados.localidade + ', ' + dados.uf;
                        $('#endereco').val(endereco);
                        console.log(dados);
                    }, 'json');
                });
            });
            
            
        </script>

    </body>

</html>