<?php

class News
{
    public $db;
    public $news;


    public function __construct(PDO $db, $arr = NULL)
    {
        if ($arr == NULL) {
            $this->db = $db;
            $query = $db->query('select * from news');
            $this->news = $query->fetchAll();
        } else {
            // $arr - массив id которые соответсвуют id  в бд
            //ключ массива должен быть цыфрой
            $this->news = [];
            $query = 'SELECT * FROM news WHERE id=:id';
            foreach ($arr as $key => $value)
                if (is_int($key)) {
                    $query_p = $db->prepare($query);
                    $query_p->bindValue(':id', $value);
                    $query_p->execute();
                    $this->news[] = $query_p->fetch();
                }
        }
    }

}

