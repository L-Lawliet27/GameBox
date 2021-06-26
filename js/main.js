/*Common Function To confirm throught prompt*/
function confirmAction(url) {
    var answer = confirm ('This action cannot be undone.\n Are you sure you want inactivate this item?');
    if (answer) {
        location.href = url;
    }
};

/*Validation for input in all forms identified*/ 
$(document).on("submit", "#signUp, #login, #startStream, #createDiscussion", function (e) {

    //e.preventDefault();

    var valid = true, frtChar = false,  message = '';
    if($(this).attr("id") === 'startStream' || $(this).attr("id") === 'createDiscussion' ){
        frtChar = true;
    }
    
    $('form input[type="text"]').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            var inputName = $this.attr('name');
            var named = (frtChar == false ? inputName.substring(1) : inputName);
            valid = false;
            message += 'Please enter the ' + named + '\n';
        }
    });

    $('form input[type="date"]').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            var inputName = $this.attr('name');
            var named = (frtChar == false ? inputName.substring(1) : inputName);
            valid = false;
            message += 'Please enter the ' + named + '\n';
        }
    });

    $('form input[type="url"]').each(function() {
        var $this = $(this);
        
        if(!$this.val()) {
            var inputName = $this.attr('name');
            var named = (frtChar == false ? inputName.substring(1) : inputName);
            valid = false;
            message += 'Please enter the ' + named + '\n';
        }
    });


  
        var nameButon="";
        $('form input[type="radio"]').each(function() {
                var name = $(this).attr('name');
                console.log(name);
                if(nameButon!=name){
                    if(!$(this).is(':checked')) {
                        var inputName = $(this).attr('name');
                        var named = inputName.substring(1);
                        valid = false;
                        message += 'Please enter the ' + named + '\n';
                    }
                }
                nameButon=name;
        });


    /*Showin*/
    if(!valid) {
        alert(message);
    }
    
    //Pass

});

/* Preview Validation throught Js to send data before Logged In */
window.addEventListener( "load", function () {

    function sendData(){

        const XHR = new XMLHttpRequest();

        const FD = new FormData(document.getElementById("login"));

        // Define what happens on successful data submission
        XHR.addEventListener( 'load', function(event) {
            document.getElementById("login").submit();
        });

        // Define what happens in case of error
        XHR.addEventListener( 'error', function(event) {
            alert( 'Oops! Server Error.' );
        } );

        // Set up the request
        XHR.open( 'POST', '/GameBox/login/login.php' );

        // Add the required HTTP header for form data POST requests
        XHR.setRequestHeader( 'Content-Type', 'application/x-www-form-urlencoded' );

        // Finally, send the form data.
        XHR.send( FD );
    }
    
      
    // Access the form element...
    const form = document.getElementById( "login" );
  

    // Check if Exists the LoginForm.
    if ($('#login').length > 0) {
        
    
        // ...and take over its submit event.
        form.addEventListener( "submit", function ( event ) {

            // prevent sumbit before any action
            event.preventDefault();
            
            $("#errorUserName").empty(), $("#errorPassword").empty(), $('#login fieldset ul').remove();

            var password = $("#password").val(), username = $("#username").val();
            
            // Validate the empty fields
            if(password == ""){
                $("#errorPassword").text("password is empty");
            }

            if( username == "" ){
                $("#errorUserName").text("User name is empty");
            }

            // Validation Pass!, send the data to logIn
            if(username != '' && password != '' ){
                sendData();
            }

        });
    }
    //End Checking

});

function addAsFriend(myId) {
    $('#selectFriends :selected').each(function() { 
        var val = $(this).attr('value');
        var name = $(this).attr('title');
        $(this).remove();
        $('#addedFriends').append('<option value="'+val+'" title="'+name+'">'+name+'</option>');

        $.ajax({
            url: "addAsFriend.php?id_friend="+val
          }).done(function() {
            alert('You are added a '+name+' as new Friend! :)');
        });

    });
};

function removeAsFriend(myId) {
    $('#addedFriends :selected').each(function() { 
        var val = $(this).attr('value');
        var name = $(this).attr('title');
        $(this).remove();
        $('#selectFriends').append('<option value="'+val+'" title="'+name+'">'+name+'</option>');

        $.ajax({
            url: "removeAsFriend.php?id_friend="+val
          }).done(function() {
            alert('You are remove to '+name+' as a Friend :(');
        });

    });
};



//------------------------------------storeForm.js---------------------------------------------------------------------------

$(document).ready(function () {

    let fId = null;
    buttonSet(true);
    setFormType();

    let nameSet = false;
    let priceSet = false;
    let descrSet = false;
    let dateSet = false;
    let linkSet = false;
    
    let allSets = null;

    function updateSets(){
        if(fId==0){
            allSets = nameSet && priceSet && descrSet && dateSet && linkSet;
        }else if(fId==1){
            allSets = nameSet && priceSet && descrSet && linkSet;
        }
       
        buttonSet(!allSets);
    }


    $("#Name").change(function() { 

        const name = $("#Name");
        name[0].setCustomValidity("");

        const check = name[0].checkValidity();

        if(check){
            document.getElementById("nameCheck").innerHTML = "&#x2705;";
            nameSet=true;
        }else{
            document.getElementById("nameCheck").innerHTML = "&#x274E;";
            alert("Name cannot be empty");
            nameSet=false;
        }
        updateSets()
    });


    $("#Price").change(function() { 

        const price = $("#Price");
        price[0].setCustomValidity("");

        const check = price[0].checkValidity();

            if(check){
                document.getElementById("priceCheck").innerHTML = "&#x2705;";
                priceSet = true;
            }else{
                document.getElementById("priceCheck").innerHTML = "&#x274E;";
                alert("Price Cannot Be Empty");
                priceSet = false;
            }
        updateSets()
    });


    $("#Description").change(function() { 

        const descr = $("#Description");
        descr[0].setCustomValidity("");

        const check = descr[0].checkValidity();

        if(check){
            document.getElementById("descrCheck").innerHTML = "&#x2705;";
            descrSet = true;
        }else{
            document.getElementById("descrCheck").innerHTML = "&#x274E;";
            alert("Description Cannot Be Empty");
            descrSet = false;
        }
        updateSets()
    });


    $("#ReleaseDate").change(function() { 

        const date = $("#ReleaseDate");
        date[0].setCustomValidity("");

        const check = date[0].checkValidity();

        if(check){
            document.getElementById("dateCheck").innerHTML = "&#x2705;";
            dateSet = true;
        }else{
            document.getElementById("dateCheck").innerHTML = "&#x274E;";
            alert("Release Date Cannot Be Empty");
            dateSet = false;
        }
       updateSets()
    });


    $("#Link").change(function() { 

        const link = $("#Link");
        link[0].setCustomValidity("");

        const check = link[0].checkValidity();

        if(check){
            document.getElementById("linkCheck").innerHTML = "&#x2705;";
            linkSet = true;
        }else{
            
            document.getElementById("linkCheck").innerHTML = "&#x274E;";
            alert("Link Cannot Be Empty");
            linkSet = false;
        }
        updateSets()
    });



   try{
        document.getElementById("storeSubmit").onmousedown = function() { 
            if(fId==0){
                genresCheck();
                mediumsCheck();

            }else if(fId==1) typeCheck();
        };
   }catch(err){}



   function genresCheck(){
        let gSelected = false;

        var radio = document.getElementsByClassName("Genre");

        for (let index = 0; index < radio.length; index++) {
            var check = radio[index];
            if (check.checked) {
                gSelected=true;
                break;
            }
        }
        if(gSelected==false){
            alert("Select A Genre");
        }
   }

   function mediumsCheck(){
        let mSelected = false;

        var checkbox = document.getElementsByClassName("Medium");

        for (let index = 0; index < checkbox.length; index++) {
            var boxes = checkbox[index];
            if (boxes.checked) {
                mSelected=true;
            }
        }
        if(mSelected==false){
            alert("Select At Least One Medium");
        }
   }

   function typeCheck(){
        let tSelected = false;

        var radio = document.getElementsByClassName("Type");

        for (let index = 0; index < radio.length; index++) {
            var check = radio[index];
            if (check.checked) {
                tSelected=true;
                break;
            }
        }
        if(tSelected==false){
            alert("Select A Type");
        }
   }


    function buttonSet(val){
        var button = document.getElementById("storeSubmit");
        if(button!=null) button.disabled=val;
    }

    function setFormType(){
        try{
            let legend = document.getElementsByTagName("legend");
            if(legend[0].innerHTML=="Add Game") fId = 0;
            else if(legend[0].innerHTML=="Add Product")fId = 1;
        }catch(err){}
        
    }

});