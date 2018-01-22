{{ content() }}
{{ form('class': 'form-login') }}
    <div class="row">
        <p><div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <p>
                        <h4 class="text-center">
                            Credenciales
                        </h4>
                    </p>
                    <div class="form-group">
                        <p>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                                {{ form.render('username') }}
                            </div>
                        </p>
                    </div>
                    <div class="form-group">
                        <p>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-home"></span></span>
                                {{ form.render('idenEmpresa') }}
                            </div>
                        </p>
                    </div>
                    <div class="form-group">
                        <p>
                            <div class="input-group">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                                {{ form.render('password') }}
                            </div>
                        </p>
                    </div>
                    <div class="form-group">
                        <p>
                            <div class="button-group">
                                {{ form.render('Acceder') }}
                                {{ form.render('csrf', ['value': security.getToken()]) }}
                            </div>
                        </p>
                    </div>
                </div>
            </div>
        </div></p>
    </div>
</form>