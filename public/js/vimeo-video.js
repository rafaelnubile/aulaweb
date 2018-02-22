$('document').ready(function(){
    var iframe = document.querySelector('iframe');
    var player = new Vimeo.Player(iframe);

    player.on('ended', function(data) {
        var url = window.location.pathname;
        var idUltimaBarra = url.lastIndexOf('/');
        var aulaID = url.substring(idUltimaBarra + 1);

        console.log(aulaID);
        $.ajax({
          url: "/aulaAssistida/" + aulaID,
          context: document.body
        }).done(function(data) {
            if(data)
            {
                alert("aula assistida");
            }
            else
            {
                alert("não deu certo");
            }
        });
    });
});


