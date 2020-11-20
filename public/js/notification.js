(function(){

    var user;
    var messages = [];

    var conn = new WebSocket('ws://localhost:8090');
    conn.onopen = function(e) {
        console.log("Connection established!");
    };

    conn.onmessage = function(e) {
        var msg = JSON.parse(e.data);

    };


    $('#join-chat').click(function(){
        user = $('#user').val();


        var msg = {
            'user_id': user,
            'to': 429,
            'content': user + ' entered the room'
        };

        conn.send(JSON.stringify(msg));
    });


    $('#send-msg').click(function(){
        var text = $('#msg').val();
        var msg = {
            'user_id': user,
            'to': 429,
            'content': text
        };
        updateMessages(msg);
        conn.send(JSON.stringify(msg));

        $('#msg').val('');
    });


    $('#leave-room').click(function(){

        var msg = {
            'user_id': user,
            'to': 429,
            'content': user + ' has left the room'
        };
        updateMessages(msg);
        conn.send(JSON.stringify(msg));

        $('#messages').html('');
        messages = [];

        $('#main-container').addClass('hidden');
        $('#user-container').removeClass('hidden');

        conn.close();
    });

})();