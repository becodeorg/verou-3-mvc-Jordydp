<?php require 'View/includes/header.php'?>

<?php

 // Use any data loaded in the controller here 
    
?>

<section>
    <h1>Articles</h1>
    <ul>
        <?php foreach ($articles as $article) : ?>
            <li><a href="index.php?page=articles-show&id=<?=$article->id?>"><?= $article->title ?></a> - by <a href="index.php?page=articles-author&author=<?=$article->author?>"><?= $article->author?></a></li>
        <?php endforeach; ?>
    </ul>
</section>

<?php require 'View/includes/footer.php'?>