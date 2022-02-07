<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Main Page</title>
    <style>
             table {
                 border-collapse: collapse;
                 width: 100%;
                 color: black;
                 font-family: monospace;
                 font-size: 25px;
                 text-align: center;
                }
             th {
                  color: black;
                }
            
         </style>
    <link
    rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk"
    crossorigin="anonymous"
  />
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.css"
    />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/css/swiper.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/5.4.5/js/swiper.min.js"></script>
  <link rel="stylesheet" href="style.css">
  </head>
  <body>
  <?php
                    $conn = mysqli_connect("localhost", "root", "", "manthan");
                    // Check connection
                    if ($conn->connect_error)  
                            {
                            die("Connection failed: " . $conn->connect_error);
                            }
                        $sql = "SELECT * FROM store_val";
                        $result = $conn-> query($sql);
                        $row = $result -> fetch_assoc();
                       
  ?>

      <div class="row">
          <div class="upload">
          

          <div class="container">
         <div class="wrapper">
            <div id="upimg">
            <div class="image">
               <img src="" alt="" width="150" height="150">
            </div>
            <div class="content">               
            </div>
            <div id="cancel-btn">
               <i class="fas fa-times"></i>
            </div>
            <div class="file-name">
               File name here
            </div>
            </div>
         </div>
         <button onclick="defaultBtnActive()" id="custom-btn">Choose a file</button>
         <input id="default-btn" type="file" hidden>
      </div>
      <script>
         
         const wrapper = document.querySelector(".wrapper");
         const fileName = document.querySelector(".file-name");
         const defaultBtn = document.querySelector("#default-btn");
         const customBtn = document.querySelector("#custom-btn");
         const cancelBtn = document.querySelector("#cancel-btn i");
         const img = document.querySelector("img");
         let regExp = /[0-9a-zA-Z\^\&\'\@\{\}\[\]\,\$\=\!\-\#\(\)\.\%\+\~\_ ]+$/;
         function defaultBtnActive(){
           defaultBtn.click();
         }
         defaultBtn.addEventListener("change", function(){
           const file = this.files[0];
           if(file){
             const reader = new FileReader();
             reader.onload = function(){
               const result = reader.result;
               img.src = result;
               wrapper.classList.add("active");
             }
             cancelBtn.addEventListener("click", function(){
               img.src = "";
               wrapper.classList.remove("active");
             })
             reader.readAsDataURL(file);
           }
           if(this.value){
             let valueStore = this.value.match(regExp);
             fileName.textContent = valueStore;
           }
         });
      </script>



<!-- upload end -->

          </div>
      <div class="resultbutton" >
        <div class="d-grid gap-2 d-md-block">
            <button class="btn btn-primary" type="button" onclick="myFunction()">Get Results</button>
          </div>
      </div>
      <script>
        var req = new XMLHttpRequest(); 
function myFunction() {
    <?php 
      if($row["post"]=="https://www.w3schools.com/images/w3schools_green.jpg"){
    ?>
      document.getElementById("panel").style.display = "block";
    document.getElementById("panel1").style.display = "block";
   
    <?php
     }
    else {
      alert("Hello! I am an alert box!!");
      } 
      ?>
  }
   


</script>

 
     <div id="panel" class="status">        
        <?php
        $s = $row["post"];
        echo '<img src="'.$s.'">';
        ?>
          
    </div>
      </div>
      <div id="panel1" class="table row" >
      <table >
              <tr>
                 <th>Post</th>
                 <th>Id</th>
                 <th>Time and Date</th>
                 <th>Count</th>
             </tr>
             <?php
                        
                        if ($result->num_rows > 0) {                        
                         while($row) {
                              echo "<tr><td>".$row["post"]."</td><td>".$row["id"]."</td><td>".$row["timeanddate"]."</td><td>".$row["count"]."</td></tr>";
                              break;
                            }
                         echo "</table>";
                        } else { echo "0 results"; }
                        $conn->close();
                ?>
           </table>
      </div>

      

  </body>
</html>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script
      src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
      integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
      integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
      crossorigin="anonymous"
    ></script>
    <!-- Initialize Swiper -->
    <script>
      var swiper = new Swiper(".swiper-container", {
        slidesPerView: 1,
        spaceBetween: 30,
        loop: true,

        navigation: {
          nextEl: ".swiper-button-next",
          prevEl: ".swiper-button-prev",
        },
      });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.min.js"></script>

   
  </body>
</html>