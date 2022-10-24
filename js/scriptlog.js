function submitData(){ 
    var datalog = { 
      fullname: $("#fullname").val(), 
      username: $("#usernameentry").val(), 
      password: $("#passwordentry").val(), 
      action: $("#actionentry").val(), 
    }; 
    if(datalog.username == '' && datalog.password == ''){
      swal({ 
        icon : 'error', 
        title : 'Oops...', 
        text: 'Username & Password harus di isi', 
        timer : 1000, 
        buttons : false, 
      }) 
    }else if(datalog.username  && datalog.password == ''){
      swal({ 
        icon : 'error', 
        title : 'Oops...', 
        text: 'Password harus di isi', 
        timer : 1000, 
        buttons : false, 
      }) 

    }else if(datalog.username == '' && datalog.password){
      swal({ 
        icon : 'error', 
        title : 'Oops...', 
        text: 'Username harus di isi', 
        timer : 1000, 
        buttons : false, 
      }) 

    } else {
      $(document).ready(function(){ 
 
        $.ajax({ 
            url: 'functions.php', 
            type: 'post', 
            data: datalog, 
            success:function(response){ 
            var nama2 = document.getElementById('usernameentry').value ;
            if(response == "Entry Successful"){ 
                swal({ 
                icon : "success", 
                title : "You have Entered.",
                text: "Welcome to Hell, " + nama2, 
                timer : 5000, 
                buttons : false, 
                }) 
                var detik  
                detik = setTimeout(move, 5000) 
                function move(){ 
                window.location.href = "game.php" 
                } 
            }else if( data.password!=""){
                swal({ 
                icon : 'error', 
                title : 'Oops...', 
                text: 'Password Salah',   
                buttons: false, 
                }) 
            }else{ 
                swal({ 
                icon : 'error', 
                title : 'Oops...', 
                text: 'Username & Password Salah', 
                buttons: false, 
                }) 
            } 
            } 
        }); 
    }); 
    }
    
  } 