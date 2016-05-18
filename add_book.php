<?php
$title = 'Nova knjiga';
include './inc/header.php';
?>

<a href="index.php">Spisak</a>
<form  method="post" action="add_book.php">
    Ime: <input type="text" name="book_name"/>
    <?php
    $autors = getAuthors($db);

    if ($autors === FALSE) {
        echo 'Greska';
        ///TODO
    }
    ?>
    <div>
        Autori:<select name="autors[]" multiple>
            <?php
            foreach ($autors as $row) {
                echo '<option value="' . $row['author_id'] . '">' . $row['author_name'] . '</option>';
            }
            ?>
        </select>
    </div>
    <input type="submit" value="Dodaj" />
</form>

<?php
if ($_POST) {
    $book_name = trim($_POST['book_name']);
    if (!isset($_POST['autors'])) {
        $_POST['autors'] = '';
    }
    $autors = $_POST['autors'];
    $error = [];
    if (mb_strlen($book_name) < 2) {
        $error [] = '<p>Pogresno ime!</p>';
    }
    if (!is_array($autors) || count($autors) == 0) {
        $error[] = '<p>Greska!</p>';
    }
    if (!isAuthorIdExist($db, $autors)) {
        $error [] = 'pogresan autor!';
    }


    if (count($error) > 0) {
        foreach ($error as $v) {
            echo '<p>' . $v . ' </p>';
        }
    } else {
        mysqli_query($db, 'INSERT INTO books (book_title) VALUES ("' . mysqli_real_escape_string($db,$book_name) . '")');

        if (mysqli_error($db)) {
            echo 'Greska!';
        }
        $id= mysqli_insert_id($db);
        
        foreach ($autors as $authors_id) {
            mysqli_query($db, 'INSERT INTO books_authors(books_id , author_id) VALUES ('.$id.', '. $authors_id .')');
            if(mysqli_error($db)){
                echo 'Error';
                
            }
        }
        echo 'Knjiga je dodata uspesno!';
    }
}
?>

<?php
include './inc/footer.php';
