$(function() {
    //Fonction permettant d'attaquer ws/loginws/login
    $('#loginFormLogin_form').submit(function(e){
        login(e,$(this));
    });

    $('#resetLogin_input').click(function(e){
        resetInfo();
    });

});