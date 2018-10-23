<div class="login-box">
    <div class="login-box-body">
        <p class="login-box-msg">Iniciar Sessão</p>
        <p  class="alert alert-danger" style="display: none;" id="erro_login">e-mail ou senha incorretos.</p>
        <?php 
        
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
                "class" => "form-control",
                "type" => "password"
            ));

            echo form_button(array(
                "class" => "btn btn-info",
                "type" => "button",
                "onclick" => "login()",
                "content" => "Login"
            ));


        ?>
    </div>
</div>