<nav>
        <div class="brand">
            <h2>Manish</h2>
        </div>
        <div class="sidebar">
            <ul>
                <li id="dashboard"><a href="dashboard.php"><i class="fa-solid fa-dashboard"></i>Dashboard</a></li>
                <li id="expense"><a href="expense.php"><i class="fa-solid fa-indian-rupee-sign"></i>Expense</a></li>

                <li id="reports"><a href="reports.php"><i class="fa-solid fa-chart-bar"></i>Reports</a></li>
          
                <li><a href="php/logout.php"><i class="fa-solid fa-power-off"></i>Logout</a></li>
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