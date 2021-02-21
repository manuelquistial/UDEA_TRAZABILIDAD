<div id="wrapper">  
        <div id="user-container">   
            <label for="user">What's your name?</label>
            <input type="text" id="user" name="user">
            <button type="button" id="join-chat">Join Chat</button>
        </div>

        <div id="main-container" class="hidden">        
            <button type="button" id="leave-room">Leave</button>
            <div id="messages">

            </div>

            <div id="msg-container">
                <input type="text" id="msg" name="msg">
                <button type="button" id="send-msg">Send</button>
            </div>
        </div>

    </div>

    <script id="messages-template" type="text/x-handlebars-template">
        
        <div class="msg">
            <div class="time"></div>
            <div class="details">
                <span class="user"></span>: <span class="text"></span>
            </div>
        </div>
        
    </script>

    
<script src="{{ asset('js/main.js') }}" ></script> 