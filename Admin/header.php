<nav>
        <div class="brand">
            <h2>Manish</h2>
        </div>
        <div class="sidebar">
            <ul>
                <li id="dashboard"><a href="category.php"><i class="fa-solid fa-hashtag"></i>Category</a></li>

                <li id="expense"><a href="users.php"><i class="fa-solid fa-users"></i>Users</a></li>
          
                <li><a href="../php/logout.php"><i class="fa-solid fa-power-off"></i>Logout</a></li>
            </ul>
        </div>
        <div id="navBtn">
            <i class="fa-solid fa-bars"></i>
        </div>
    </nav>
    <div class="overlay"></div>
    <script>
        function navactive(id){
      document.getElementById(id).classList.add("active");
        }
    </script>