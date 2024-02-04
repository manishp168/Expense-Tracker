
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
    <link rel="stylesheet" href="../style/main.css">
    <link rel="stylesheet" href="../style/login.css" />
  </head>
  <body>
    <!--<div id="toast-container"></div>-->
    <div class="container">
      <h4>Admin Login</h4>
      <div class="form">
  <div id="toast-container"></div>
        <form id="loginForm">
          <div class="input-box">
            <div class="input-icon">
              <i class="fa-solid fa-user"></i>
            </div>
            <input
              type="text"
              name="username"
              id="username"
              class="input"
              placeholder="Enter Username"
              required
            />
          </div>
          <div class="input-box">
            <div class="input-icon">
              <i class="fa-solid fa-lock"></i>
            </div>
            <input
              type="password"
              name="password"
              id="password"
              class="input"
              placeholder="Enter Password"
              required
            />
          </div>
          <div class="submit-btn">
            <input
              type="submit"
              value="Login"
              class="submit"
            />
          </div>
        </form>
      </div>
    </div>
    
    <script src="../script/toast.js"></script>
    
    <script>
      
      document
        .getElementById("loginForm")
        .addEventListener("submit", function (event) {
          event.preventDefault();
          var username = document.getElementById("username").value;
          var password = document.getElementById("password").value;
          let res = document.getElementById("response");
          var xhr = new XMLHttpRequest();
          
          xhr.open("POST", "login.php", true);
          xhr.setRequestHeader(
            "Content-Type",
            "application/x-www-form-urlencoded"
          );

          xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
              var response = JSON.parse(xhr.responseText);
              if (response.success) {
                showToast(response.message, 3000, "success");
                setTimeout(function () {
                  window.location.href = "category.php";
                }, 2000);
              } else {
                showToast(response.message, 3000, "error");
              }
            }
          };

          var data =
            "username=" +
            encodeURIComponent(username) +
            "&password=" +
            encodeURIComponent(password);
          xhr.send(data);
        });
    </script>
  </body>
</html>
