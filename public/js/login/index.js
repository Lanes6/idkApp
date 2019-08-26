$(function() {

});

//Fonction permettant d'attaquer ws/loginws/login
function login(bouttonSubmit,formLogin) {
    bouttonSubmit.preventDefault();
    resetInfo();
    var loginInput=$("#loginLogin_input");
    var passwordLogin=$("#passwordLogin_input");
    if(loginInput.val()=="" || passwordLogin.val()==""){
        displayInfo("<p>Veuillez remplir les champs en rouge</p>","red");
        if(loginInput.val()==""){
            errorInput(loginInput);
        }
        if(passwordLogin.val()==""){
            errorInput(passwordLogin);
        }
    }else{
        var url="ws/loginws/login";
        var data=formLogin.serialize();
        $.ajax({
            type: "POST",
            url:url,
            data : data,
            dataType : 'json',
            complete: function(res) {
                switch (res.status) {
                    case 200:
                        if (typeof(Storage) !== "undefined") {
                            localStorage.setItem(JWTPLACE, res.responseJSON.jwt);
                            localStorage.setItem(JWTREDRESHPLACE, res.responseJSON.jwtRefresh);
                            displayInfo("Connecté!","green");
                            window.location.replace("user");
                        } else {
                            displayInfo("Votre navigateur n'est pas compatible avec le HTMLStorage","red");
                        }
                        break;
                    case 403:
                        displayInfo("Couple login mot de passe incorrect","red");
                        break;
                    default:
                        var statusTab=statusToMsg(res.status,"login");
                        displayInfo(statusTab[0],statusTab[1]);
                }
            }
        });
    }
}