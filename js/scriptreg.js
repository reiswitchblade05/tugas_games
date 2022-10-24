function submitDatareg(){ 
    var data = { 
      fullname: $("#fullname").val(), 
      username: $("#username").val(), 
      password: $("#password").val(), 
      action: $("#action").val(), 
    }; 
 
    if(data.username==""  && data.password== "" && data.fullname ==""){ 
      swal({ 
        title : "Form harus di isi", 
        icon : "error", 
        timer : 2000, 
        buttons: false, 
      }) 
    }else if(data.username==""  && data.password== "" && data.fullname){ 
      swal({ 
        title : "Username dan Password di isi", 
        icon : "error", 
        timer : 2000, 
        buttons: false, 
      }) 
    }else if(data.username  && data.password== "" && data.fullname ==""){ 
      swal({ 
        title : "Nama dan Password harus di isi", 
        icon : "error", 
        timer : 2000, 
        buttons: false, 
      }) 
    } else if(data.username== ""  && data.password && data.fullname ==""){ 
      swal({ 
        title : "Nama dan Username harus di isi", 
        icon : "error", 
        timer : 2000, 
        buttons: false, 
      }) 
    }else if(data.username  && data.password== "" && data.fullname){ 
      swal({ 
        title : "Password harus di isi", 
        icon : "error", 
        timer : 2000, 
        buttons: false,
      }) 
    }else if(data.username==""  && data.password  && data.fullname){ 
      swal({ 
        title : "Username harus di isi", 
        icon : "error", 
        timer : 2000, 
        buttons: false, 
      }) 
    }else if(data.username && data.password  && data.fullname==""){ 
      swal({ 
        title : "Nama harus di isi", 
        icon : "error", 
        timer : 2000, 
        buttons : false, 
      }) 
    }else{ 
      var username = document.getElementById('username').value 
      $(document).ready(function(){ 
 
        $.ajax({ 
        url: 'functions.php', 
        type: 'post', 
        data: data, 
        success:function(response){ 
          if(response == "Successful"){ 
            swal({ 
                icon : 'error', 
                title : 'Oops...', 
                text : 'Username sudah terdaftar',  
                buttons : false
            }) 
          }else{ 
            swal({ 
                icon : "success", 
                title : "You have applied!", 
                buttons : false, 
              }) 
              var detik  
              detik = setTimeout(move, 5000) 
              function move(){ 
                window.location.href = "index.php" 
              } 
          } 
        } 
      }); 
    }); 
  } 
}
