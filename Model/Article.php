<?php

declare(strict_types=1);

class Article
{
    public string $title;
    public ?string $description;
    public ?string $publishDate;
    public ?string $id;
    public ?string $image;
    public ?string $author;

    public function __construct(string $title, ?string $description, ?string $publishDate, ?string $id, ?string $image, ?string $author)
    {
        $this->title = $title;
        $this->description = $description;
        $this->publishDate = $publishDate;
        $this->id = $id;
        $this->image = $image;
        $this->author = $author;
    }
    // format = 'D-M-Y = weekday- month -year  example= friday januari 1992 || d-m-Y = 10-01-1992
    public function formatPublishDate($format = 'd-m-Y')
    {
        //return the date in the required format
        $source = $this->publishDate;
        $date = new DateTime($source);
        echo $date->format($format); 

    }
}