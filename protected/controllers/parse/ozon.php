<?php
  include_once('simple_html_dom.php');
  echo '<a href="http://static.ozone.ru/multimedia/yml/facet/div_book.xml">http://static.ozone.ru/multimedia/yml/facet/div_book.xml</a>';
  $fp = fopen("category.xml", "r"); // Открываем файл в режиме чтения
  /*if ($fp)
  {
    echo '----------<br>';
    $sch = 0;
    while (!feof($fp))
    {
      $mytext = fgets($fp);
      if (!strpos($mytext, 'parentId'))
        echo $mytext."<br />";
      if (trim($mytext) == '</offer>')
        break;
    }
    echo '----------<br>';
  }
  else echo "fail";*/
  fclose($fp);
  /*$smpl_xml = simplexml_load_file('http://static.ozone.ru/multimedia/yml/facet/book.xml');
  $sch = 0;
  foreach ($smpl_xml->shop->offers->offer as $offer) {
    $sch++;
  }
  echo $sch;*/
  /*$html = new simple_html_dom();
  echo '---------------------begin----------------<br>';
  $id = '28788268';
  $html->load_file('http://www.ozon.ru/context/detail/id/'.$id.'/');
  $description_dom = $html->find('div.mDetail_SidePadding table td', -1);
  $description_dom->find('div.eDetail_SectionHeader', 0)->outertext = '';
  $description = trim(preg_replace('/<!--(.*?)-->/', '', $description_dom->innertext));
  echo $description;
  echo '<br>------------------<br>';
  $isNew = 0;
  $isBestseller = 0;
  foreach ($html->find('div.eMarketMessages_Tag') as $elem)
  {
  	if ($elem->plaintext == 'Íîâèíêà')
		$isNew = 1;
	if ($elem->plaintext == 'Áåñòñåëëåð')
		$isBestseller  = 1;
  }
  echo 'Íîâèíêà = '.$isNew;
  echo '<br>------------------<br>';
  echo 'Áåñòñåëëåð = '.$isBestseller;
  echo '<br>------------------<br>';
  $like_count = $html->find('span#likeButtonCountText', 0)->plaintext;
  $not_like_count = $html->find('span#notlikeButtonCountText', 0)->plaintext;
  
  echo 'like = '.$like_count;
  echo '<br>------------------<br>';
  echo 'not like = '.$not_like_count;
  echo '<br>------------------<br>';
  $mark_reviews = $html->find('div[itemprop=ratingValue]', 0)->plaintext;
  
  echo 'mark_reviews = '.$mark_reviews;
  echo '<br>------------------<br>';
  if ($html->find('div[itemprop=ratingValue]', 0))
  {
    echo 'review ok <br>';
    $html_review = new simple_html_dom();
    $html_review->load_file('http://www.ozon.ru/reviews/28788268/');
    foreach ($html_review->find('div[itemprop=review]') as $review)
    {
      $author_dom = $review->find('p[itemprop=author]', 0);
      $author_dom->find('a', 0)->outertext = '';
      $fio = $author_dom->innertext;
      echo 'fio = '.$fio.'<br>';
      $date = $review->find('span[itemprop=datePublished]', 0)->content;
      echo 'date = '.$date.'<br>';
      $mark = $review->find('meta[itemprop=ratingValue]', 0)->content;
      echo 'mark = '.$mark.'<br>';
      $text = $review->find('p[itemprop=description]', 0)->plaintext;
      echo 'text = '.$text.'<br>';
      break;
    }
    $html_review->clear();
    unset($html_review);
  }
  echo '<br>---------------------end----------------';
  $html->clear();
  unset($html);*/
?>