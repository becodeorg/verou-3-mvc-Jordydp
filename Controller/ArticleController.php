<?php

declare(strict_types = 1);

class ArticleController
{
    //
    private DatabaseManager $databaseManager;

    // This class needs a database connection to function
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
    }

    public function index()
    {
        // Load all required data
        $articles = $this->getArticles();

        // Load the view
        require 'View/articles/index.php';
    }

    // Note: this function can also be used in a repository - the choice is yours
    private function getArticles()
    {
        
        
        // Note: you might want to use a re-usable databaseManager class - the choice is yours
        // fetch all articles as $rawArticles (as a simple array)
        $sql = "SELECT * FROM articles";
        $stmt = $this->databaseManager->connection->query($sql, PDO::FETCH_ASSOC);
        $rawArticles =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        $articles = [];
        foreach ($rawArticles as $rawArticle) {
            // We are converting an article from a "dumb" array to a much more flexible class
            $articles[] = new Article($rawArticle['title'], $rawArticle['description'], $rawArticle['publish_date'], $rawArticle['id']);
        }

        return $articles;
    }

    public function show()
    {
        //this can be used for a detail page
        $sql = "SELECT * FROM articles WHERE id = {$_GET['id']}";
        $stmt = $this->databaseManager->connection->query($sql,PDO::FETCH_ASSOC);
        $article = $stmt->fetch(PDO::FETCH_ASSOC);
        $article = new Article($article['title'],$article['description'], $article['publish_date'], $article['id']);
        require 'View/articles/show.php';
                
    }

    // public function getId()
    // {
    //     if(!isset($_GET['id'])){
    //         echo "No id found";
    //     }

    //     $stmt = $this->databaseManager->connection->prepare("SELECT id From articles WHERE id = :id");
    //     $stmt->execute(array(":id"=> $_GET['id']));
    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //     $id = $row['id'];

    //     return $id;

    // }

    public function nextId($id)
    {
        $stmt = $this->databaseManager->connection->prepare("SELECT id From articles WHERE id > $id ORDER BY id LIMIT 1");
        $stmt->execute();
        $next = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
        return $next;
        //require 'View/articles/show.php';
    }

    public function previousId($id)
    {
      
        $stmt = $this->databaseManager->connection->prepare("SELECT id From articles WHERE id <= :id ORDER BY id LIMIT 1");
        $stmt->execute(array(":id"=>$id));
        $previous = $stmt->fetch(PDO::FETCH_ASSOC)['id'];
        if($previous == 1){
            echo "This is the first one";
        }      
        return $previous;
        //require 'View/articles/show.php';
    }
}

