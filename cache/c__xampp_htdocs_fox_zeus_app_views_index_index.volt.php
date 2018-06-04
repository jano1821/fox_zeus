<?= $this->getContent() ?>
<?= $this->partial('index/teclado') ?>
<?= $this->tag->form(['class' => 'form-login', 'autocomplete' => 'off', 'id' => 'loginForm']) ?>
<div class="row"><!-- este div es para el formulario -->
    <p>
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="col-md-5 col-md-offset-3">
                    <p>
                    <h4 class="text-center">
                        Credenciales
                    </h4>
                    </p>
                </div>

                <div class="col-md-5 col-md-offset-3">
                    <p>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            <?= $form->render('username') ?>
                    </div>
                    </p>
                </div>

                <div class="col-md-5 col-md-offset-3">
                    <p>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                            <?= $form->render('idenEmpresa') ?>
                    </div>
                    </p>
                </div>

                <div class="col-md-5 col-md-offset-3">
                    <p>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            <?= $form->render('password') ?>
                    </div>
                    </p>
                </div>


                <div class="col-md-5 col-md-offset-3">
                    <p><!-- Esta etiqueta es para darle espaciado superior e inferior en el div  -->
                    <h4 class="text-center">
                        <div class="button-group">
                            <?= $form->render('Acceder') ?>
                            <?= $form->render('csrf', ['value' => $this->security->getToken()]) ?>
                        </div>
                    </h4>
                    </p>
                </div>
            </div>
        </div>
    </div>
</p>
</div>

</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#teclado').on("click", function (e) {
            e.preventDefault();

        });
    });

</script>