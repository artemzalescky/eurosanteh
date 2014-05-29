
<?	
	// выводим путь к каталогу товара
?>
	<div id="catalog_tree">
<?	
		foreach ($product['catalog_tree'] as $i => $v) {
			echo '<a href="/' . $v['url'] . '"><div class="item_of_tree">' . $v['name_rus'] . '</div></a>';
		
			if ($i<count($product['catalog_tree'])-1) {
				echo '<div><img src="/images/next2.png"> </div>';
			}
		}
?>
	</div>
	<div style="clear:both"></div>


	


<div id="product_container">

	<div id="product_container_title">
		<h3><?=$product['name']?></h3>
	</div>

	<div id="product_container_image">
		<a id="show_picture" href="/<?=$product['picture_url']?>"> <img style="float:right;" src="/<?=$product['picture_url']?>"> </a>
	</div>

	<div id="product_container_description">
			
<?
	foreach ($product as $i => $v) {
		if ($v) {	// если параметр задан, т.е. не ноль
			if (!empty($product['eng_rus']["$i"]) && ($product['eng_rus']["$i"] != '*'))	// выводим русское название атрибута
				echo '<div>' . $product['eng_rus']["$i"] . ' : ' . $v . '</div>';
				
			if ($product['eng_rus']["$i"] == '*')											// не выводим ..
				echo '<div>' . str_replace("\n","</div><div>",$v) . '</div>';
		}
	}
?>
		<div> Цена: <?=$product['price']?></div>	
	
		<div class="product_buy" onClick="location.href='/cart?in_cart_catalog_id=<?=$product['id_catalog']?>&in_cart_product_id=<?=$product['id']?>'">
			В корзину
		</div>
	</div>

	<div id="product_container_footer"></div>
	
</div>	