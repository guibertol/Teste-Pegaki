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

<div class="login-box" style="width: 0px;"><button class="btn btn-info" onclick="logout()">Sair</button></div>