
<script>
   function change_cat(){
   	var category_id=document.getElementById('category_id').value;
   	window.location.href='?category_id='+category_id;
   }
   
   function delete_confir(id,page){
   	var check=confirm("Are you sure");
   	if(check==true){
   		window.location.href=page+"?type=delete&id="+id;
   	}
   }
   
   function set_to_date(){
   	var from_date=document.getElementById('from_date').value;
   	document.getElementById('to_date').setAttribute("min",from_date);
   }
</script>
<script>
        let navBtn = document.querySelector("#navBtn");
        let sidebar = document.querySelector(".sidebar");
        let overlay = document.querySelector(".overlay");

        navBtn.addEventListener("click", ()=>{
            sidebar.classList.toggle("show");
            // overlay.addEventListener("click", ()=>{
            //     overlay.classList.add("active")
            // })
            if (sidebar.classList.contains("show")) {
                navBtn.innerHTML = `<i class="fa-solid fa-close"></i>`;
                overlay.classList.add("active")
                overlay.addEventListener("click", ()=>{
                sidebar.classList.remove('show');
                overlay.classList.remove('active');
                navBtn.innerHTML = `<i class="fa-solid fa-bars"></i>`;

            });
            } else{
                navBtn.innerHTML = `<i class="fa-solid fa-bars"></i>`;
                overlay.classList.remove('active');
            }
        })
    </script>
</body>
</html>