<?php
while ($row = mysqli_fetch_assoc($result)) {
    // print_r($row['username']);
    $output .= "
    
    <div class='wrap'>
        <span class='contact-status'></span>
        <img src='./php/upload/" . $row['user_img'] . "' alt='" . $row['user_img'] . "' />
        <div class='meta'>
            <p class='name'>" . $row['username'] . "</p>
            <p class='preview'><span>You:</span> That's bullshit. This deal is solid.</p>
        </div>
    </div> 
    ";
}
