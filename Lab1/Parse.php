<?php
function Parse($p1, $p2, $p3) {
    $num1 = strpos($p1, $p2);
    if ($num1 === false) return 0;
    $num2 = substr($p1, $num1);
    $txt=strip_tags(substr($num2, 0, strpos($num2, $p3)));
    $txt1 = htmlentities($txt);
    $cleanedstr1 = str_replace("&nbsp;",'',$txt1);
    $cleanedstr2 = str_replace("$",'',$cleanedstr1);
    $cleanedstr = str_replace("&amp;nbsp;",'',$cleanedstr2);
    $dbl= floatval($cleanedstr);
    $dbl+=$dbl*0.1;
    return $dbl;
}
$link = $_POST['link'];
$String = file_get_contents($link);
if (strpos($link,"aliexpress"))
    $site="aliexpress";
else if(strpos($link,"amazon"))
    $site="amazon";
else
    $site="ebay";
switch ($site)
{
    case "aliexpress":
        if (Parse($String, '<span itemprop="lowPrice">', '</span>')==0)
            echo "Цена: ",Parse($String, '<span id="j-sku-price" class="p-price" itemprop="price">', '</span>')," рублей";
        else
            echo "Цена: ",Parse($String, '<span itemprop="lowPrice">', '</span>')," рублей";
        break;
    case "ebay":
            echo "Цена: ",Parse($String, '<span id="convbidPrice" style="white-space: nowrap;font-weight:bold;">', '</span>')," рублей";
        break;
    case "amazon":
        echo "Цена: ",Parse($String, ' <span id="priceblock_ourprice" class="a-size-medium a-color-price priceBlockBuyingPriceString">', '</span>')," USD";
        break;
}
?>

