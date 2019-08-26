$(function () {
    loadUsers();
});

//Fonction permettant d'attaquer ws/userws/
function loadUsers() {
    var html = "";
    var url = "ws/userws/selectall";
    $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        beforeSend: function(request){
            request.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem(JWTPLACE));
        },
        complete: function (res) {
            switch (res.status) {
                case 200:
                    for (let user of res.responseJSON.users) {
                        html += "<tr>" +
                            "<td>" +
                            user._id_user +
                            "</td>" +
                            "<td>" +
                            user._login +
                            "</td>" +
                            "<td>" +
                            user._password +
                            "</td>" +
                            "</tr>";
                    }
                    $("#listUser_table").append(html);
                    break;
                default:
                    var statusTab = statusToMsg(res.status,"loadUsers");
                    displayInfo(statusTab[0], statusTab[1]);
            }
        }
    });
}
