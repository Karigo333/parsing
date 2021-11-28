<?php

require_once "../db/db_connect.php";



$url = 'https://dailytargum.com/section/news';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec(($ch));
curl_close($ch);


//block News
preg_match_all('#<div\s+[^>]*?class\s*=\s*(["\'])jsx-1859068249 col\1[^>]*?>(.*?)</div>#s', $content, $match);

foreach ($match[0] as $item) {

    //image
    preg_match_all('#<img.+?src\s*?=\s*?(["\'])(.*?)\1[^>]*?>#su', $item, $image);
    $image = implode($image[2]);
    $image = stristr($image, '?', true);

    preg_match_all('#<a\s+class\s*=\s*"Card_stackedCardResponsive__pOvBg" role="article" href="(.*?)">#si', $item, $link);
    $link = $link[1];

    $page = file_get_contents('https://dailytargum.com' . (implode($link)));

    //title
    preg_match_all('#<h1[^>]+?>(.*?)</h1>#su', $page, $heading);
    $heading = implode($heading[1]);

    //date
    preg_match_all('#<time[^>]+?>(.*?)</time>#su', $page, $data);
    $data = implode($data[1]);

    //full_text
    preg_match_all('#p\s+[^>]*?class\s*=\s*(["\'])jsx-4083616078\1[^>]*?>(.*?)</p>#su', $page, $description);
    $description = implode($description[2]);


    if(!check($db,$heading))
    {
        $param = [
            'heading' => $heading,
            'description' => $description,
            'image' => $image,
            'data' => $data
        ];

        $sql = "INSERT news (heading, image, description, data) VALUE (:heading, :image, :description, :data)";
        $query = $db->prepare($sql);
        $query->execute($param);


        define('DIRECTORY', '../images/');
        $save_image = file_get_contents($image);
        $name_img = str_replace( 'https://dailytargum.imgix.net/images/', '', $image);
        file_put_contents(DIRECTORY . $name_img, $save_image);

    }
}
    function check($db,$head)
        {
            $f = $db->prepare('select heading from news where heading like :heading');
            $f->bindValue(':heading', $head);
            $f->execute();
            return $f->fetch();
        }


