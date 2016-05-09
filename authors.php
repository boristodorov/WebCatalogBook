<?php
$title='Autori:';
include './inc/header.php';
?>
<a href="index.php">Spisak</a>

<form  method="post" action="authors.php">
    Ime: <input type="text" name="author_name"/>
         <input type="submit" value="Dodaj" />   
</form>
<?php

if($_POST){
    $authors_name = trim($_POST['author_name']);
    
    if(mb_strlen($authors_name)<2){
        echo '<p>ime je prekratko!</p>';
    } else{
    $authors_esc = mysqli_real_escape_string($db,$authors_name);
    $q = mysqli_query($db, 'SELECT * FROM authors 
         WHERE author_name="'. $authors_esc .'"');
    if(mysqli_error($db)){
            echo 'Greska';
        }
    if (mysqli_num_rows($q)>0){
        echo 'Imamo takvog autora';
    }
    else {
        mysqli_query($db, 'INSERT INTO authors (author_name)
                VALUES ("'. $authors_esc .'")');
        if(mysqli_error($db)){
            echo 'Greska';
        }else{
            echo 'Zapis je uspesan';
        }
        
        
    }
  }
}
$q = mysqli_query($db, 'SELECT * FROM authors');
if(mysqli_error($db)){
    echo 'Greska!';
}
?>

<table border="1">
    <tr><th>Autori:</th></td>
    <?php
        while($row = mysqli_fetch_assoc($q)){
            echo '<tr><td>' .$row['author_name'] . '</td></tr>';
        }
    ?>
    
</table>



<?php
include './inc/footer.php';
?>