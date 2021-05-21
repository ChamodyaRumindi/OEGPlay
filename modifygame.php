
<link rel="styleSheet" href="css/sidebar.css" />
<link rel="styleSheet" href="css/add-games.css" />
<?php 
      $title = 'Modify Games';
      include 'header.php'; 
      include_once ('./includes/admin-config.inc.php');
?>

    <div class="a-container">
      <?php include 'admin-sidebar.php'; ?>
      <div class="ag-container">
        <h2>- Add a game -</h2>

        <?php 
          require 'includes/database.inc.php';

          $mid = $_GET['id'];

          echo '<form action="includes/modifygame.inc.php?id='.$mid.'" method="post" name="modify-game" onsubmit="return validateForm()" enctype="multipart/form-data" >';

          $sql = "SELECT gameName, gameGrade, gameCategory, gameSubject, gameDescription, gameInstructions, gameAccess, devID FROM Game WHERE gameID = $mid";
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) {
          $row = mysqli_fetch_assoc($result);

          $gName = $row["gameName"];
          $gGrade = $row["gameGrade"];
          $gCategory = $row["gameCategory"];
          $gSubject = $row["gameSubject"];
          $gDesc = $row["gameDescription"];
          $gInst = $row["gameInstructions"];
          $gAccess = $row["gameAccess"];
          $devID = $row["devID"];
          }
          else{
              // Error MSG
          }

          echo '<div class="form-item">
                  <label for="name">Game Name:</label>
                  <input type="text" name="gamename" id="name" value = "'.$gGrade.'" required/>
                </div>';
          echo '<div class="form-item">
                  <label for="desc">Description:</label>
                  <textarea
                    name="description"
                    id="desc"
                    rows="5"
                    cols="50"
                  >'.$gDesc.'</textarea>
                  </div>';
          echo '<div class="form-item">
                  <label for="inst">Instructions:</label>
                  <textarea
                  name="instructions"
                  id="inst"
                  rows="5"
                  cols="50"
                  >'.$gInst.'</textarea>
                  </div>';
       
              $sql = "SELECT gradeName FROM Grade";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                echo '<div class="form-item">';
                echo '<label for="grades">Grade:</label>';
                echo '<select name="grade" id="grades" required>';
                while($row = mysqli_fetch_assoc($result)) {
                  if($gGrade == $row['gradeName']){
                    echo '<option selected value="'.$row['gradeName'].'" >'.$row["gradeName"].'</option>'; 
                  }
                  else{
                    echo '<option value="'.$row['gradeName'].'" >'.$row["gradeName"].'</option>'; 
                  } 
                }
                echo '</select>';
                echo '</div>';
              } else {
                echo "O Grades Found!";
              }

              $sql = "SELECT categoryName FROM Category";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                echo '<div class="form-item">';
                echo '<label for="categories">Category:</label>';
                echo '<select name="category" id="categories" required>';
                while($row = mysqli_fetch_assoc($result)) {
                  if($gCategory == $row["categoryName"]){
                    echo '<option selected value="'.$row['categoryName'].'" >'.$row["categoryName"].'</option>';
                  }
                  else{
                    echo '<option value="'.$row['categoryName'].'" >'.$row["categoryName"].'</option>';
                  }
                }
                echo '</select>';
                echo '</div>';
              } else {
                echo "O Categories Found!";
              }

              $sql = "SELECT subjectName FROM Subject";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                echo '<div class="form-item">';
                echo '<label for="subjects">Subject:</label>';
                echo '<select name="subject" id="subjects" required>';
                while($row = mysqli_fetch_assoc($result)) {
                  if($gSubject== $row["subjectName"]){
                    echo '<option selected value="'.$row['subjectName'].'" >'.$row["subjectName"].'</option>';
                  }
                  else{
                    echo '<option value="'.$row['subjectName'].'" >'.$row["subjectName"].'</option>';
                  }
                }
                echo '</select>';
                echo '</div>';
              } else {
                echo "O Subjects Found!";
              }

              $sql = "SELECT devID FROM Developer";
              $result = mysqli_query($conn, $sql);

              if (mysqli_num_rows($result) > 0) {
                echo '<div class="form-item">';
                echo '<label for="developers">Developer ID:</label>';
                echo '<select name="developer" id="developers" required>';
                echo '<option disabled selected value> -- Select Developer -- </option>';
                while($row = mysqli_fetch_assoc($result)) {
                  if($devID == $row["devID"]){
                    echo '<option selected value="'.$row['devID'].'" >'.$row["devID"].'</option>';
                  }
                  else{
                    echo '<option value="'.$row['devID'].'" >'.$row["devID"].'</option>';
                  }
                }
                echo '</select>';
                echo '</div>';
              } else {
                echo "O Developers Found!";
              }

              echo '<div class="form-item">
                    <label for="gaccess">Access Level:</label>
                    <select name="access" id="gaccess" required>';
                    if($gAccess == "Free"){
                      echo '<option selected value="Free">Free</option>';
                      echo '<option value="Premium">Premium</option>';
                    }
                    else{
                      echo '<option value="Free">Free</option>';
                      echo '<option selected value="Premium">Premium</option>';
                    }    
              echo '</select>
                    </div>';

              mysqli_close($conn); 
          ?>

          <div class="form-item">
            <label for="gfile">New Game File:</label>
            <input type="file" name="gamefile" id="gfile"/>
          </div>

          <div class="form-item">
            <label for="gthumbnail">New Thumbnail:</label>
            <input type="file" name="thumbnail" id="gthumbnail" />
          </div>

          <div class="ag-buttons">
            <button class="addgame-btn" name = "submit" type= "submit" onclick="return confirm('Please confirm!')">Save</button>
          </div>
        </form>
      </div>
    </div>

<?php include('./footer.php'); ?>
