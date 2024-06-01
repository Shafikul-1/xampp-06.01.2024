<footer>
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);"> © 2024 Copyright:
    <?php
    include "config.php";
    $settingQuery = "SELECT * FROM setting";
    $settingResult = mysqli_query($connection, $settingQuery) or die("Setting Query Failed");
    if (mysqli_num_rows($settingResult) > 0) {
      while ($settingRow = mysqli_fetch_assoc($settingResult)) {
        echo $settingRow['footer_des'];
      }
    }
    ?>
  </div>
</footer>


<script src="https://kit.fontawesome.com/ed5a9b6893.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>