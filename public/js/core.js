$(function() {


















});

//fonction permettant d'afficher une information avec la couleur voulue
function displayInfo(content,color){
    $( ".info_div" ).html(content);
    $( ".info_div" ).css("color",color);
    $( ".info_div" ).show();
}

function errorInput(input){
    input.css("background-color","#fce4e4");
    input.css("border-color","#fc9c97");
}

//fonction permettant de reset les div info
function resetInfo(){
    $( ".info_div" ).hide();
    $( ".input" ).css("background-color","");
    $( ".input" ).css("border-color","");
}

//fonction permettant de retourner un message universel en fonction du status
function statusToMsg(status,fctCallBack,paramsCallBack){
    switch (status) {
        case 200:
            return ["Succès de l'opération","green"];
        case 201:
            return ["Succès de la création","red"];
        case 400:
            return ["Syntaxe de la requête erronée","red"];
        case 401:
            return ["Authentification nécessaire","red"];
        case 403:
            refreshJwt().then(
                setTimeout(function() {
                    executeFunction(fctCallBack,paramsCallBack);
                }, 3000)
            );
            return ["Droits d'accès insuffisants","red"];
        case 404:
            return ["Ressource inexistante","red"];
        case 500:
            return ["Erreur serveur","red"];
        case 503:
            return ["Service en maintenance","red"];
        default:
            window.location.replace("error");
    }
}

function refreshJwt(){
    var url="ws/loginws/refreshjwt";
    var to_return=new Promise(function(resolve,reject) {
        $.ajax({
            type: "GET",
            url: url,
            dataType: 'json',
            beforeSend: function (request) {
                request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem(JWTREDRESHPLACE));
            },
            complete: function (res) {
                switch (res.status) {
                    case 200:
                        localStorage.setItem(JWTPLACE, res.responseJSON.jwt);
                        break;
                    default:
                        alert('Votre jeton de session a expiré ou est invalide. Vous allez être redirigé vers la page d\'authentification');
                        window.location.replace("login");
                        break;
                }
            }
        });
    });
    return to_return;
}

function executeFunction(fct,params=null) {
    var fn = window[fct];
    if (typeof fn === "function"){
        fn.apply(null, params);
    }
}