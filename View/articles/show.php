<?php require 'View/includes/header.php'?>

<?php
//$next = $article->nextId($article->id); // Use any data loaded in the controller here 
$next = $this->nextId($article->id);
if($article->id == "1")
{
    $previous = $this->lastId();
} else {
    $previous = $this->previousId($article->id);
}

echo "<pre>";
var_dump($previous);
echo "</pre>";
;?>



<section>
    <h1><?= $article->title ?></h1>
    <p><?= $article->formatPublishDate() ?></p>
    <p><?= $article->description ?></p>

    <?php // TODO: links to next and previous ?>
    <a href="index.php?page=articles-show&id=<?= $previous?>">Previous article</a>
    <a href="index.php?page=articles-show&id=<?= $next?>">Next article</a>
</section>

<?php require 'View/includes/footer.php'?>
