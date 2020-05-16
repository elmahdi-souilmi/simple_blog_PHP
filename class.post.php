<?php
class post
{
    private $id;
    private $title;
    private $text;
    private $belong_to;
    private $create_in;
    public function __construct( $title, $text, $belong_to)
    {
        $this->title = $title;
        $this->text = $text;
        $this->belong_to = $belong_to;
    }
    // getters and setters
    public function getID()
    {
        echo $this->id;
    }
    public function getTITLE()
    {
        echo $this->title;
    }
    public function setTITLE($title)
    {
        $this->title = $title;
    }
    public function getTEXTE()
    {
        echo $this->text;
    }
    public function setTEXT($text)
    {
        $this->text = $text;
    }
    public function getBELONG_TO()
    {
        echo $this->belong_to;
    }
    public function setBELONG_TO($belong_to)
    {
        $this->belong_to = $belong_to;
    }
    public function getCREATE_IN()
    {
        echo $this->create_in;
    }
    public function setCREATE_IN($create_in)
    {
        $this->create_in = $create_in;
    }
   public function  add(){
          // connect to datebase
          include 'config/db_connect.php';
          // create sql
          $sql = " INSERT INTO post(title, text,  belong_to) VALUES( '$this->title', '$this->text', '$this->belong_to' ) ";
          // save to database and check
          if (mysqli_query($connect, $sql)) {
  
          } else {
              echo 'query error : ' . mysqli_error($connect);
          }
   }

}
