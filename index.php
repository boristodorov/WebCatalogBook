<?php
$title = 'Spisak';
include './inc/header.php';
?>

<a href="authors.php">Autori</a>
<a href="add_book.php">Nova knjiga</a>

<?php
$q = mysqli_query($db, 'SELECT * FROM books as b INNER JOIN books_authors as ba ON b.book_id = ba.books_id 
        INNER JOIN authors as a ON a.author_id = ba.author_id');



echo '<table border="1"><tr><td>Knjiga:</td><td>Autor:</td>';
while ($row = mysqli_fetch_assoc($q)){
    echo '<tr><td>'. $row['book_title'].'</td>
        <td>'. $row['author_name'].' </td>';
          
}
echo '</table>';


?>




<?php
include './inc/footer.php';
?>