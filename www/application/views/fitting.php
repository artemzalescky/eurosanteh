<?
		// выводим предков текущего каталога
	?>
		<div id="catalog_tree">
	<?	
		foreach ($info['parents'] as $i => $v) {
	?>
			<a href="/catalog/<?=$v['url']?>">
				<div class="item_of_tree"> <?=$v['name_rus']?>  </div> 
			</a>
			
	<?	
			if ($i < count($info['parents'])-1) {
	?>
				<div> <img src="/images/next2.png"> </div>
	<?		
			}
		}
	?>
		</div>
	<div style="clear:both"></div>
	



	<div class="subcatalogs">
	<? 
	if ($info['near_kids']!=0)
		foreach ($info['near_kids'] as $sub) { ?>		
			<div class="sign">
				<a href="/catalog/<?=$sub['url']?>"> <div> <img src="<?=$info['catalog_image_url']?>/<?=$sub['url']?>.jpg"> </div> </a>
				<a style='display:block; text-align:center;' href="/catalog/<?=$sub['url']?>"> <?=$sub['name_rus']?> </a>
			</div>	
			<?
		}
	?>
	</div>
	<div style="clear:both"></div>



<?php

    $max_post = 20; //максимальное количество постов на странице
    $num_post = count($products); //количество постов всего


    $num_pages =intval(($num_post-1)/$max_post) +1;   //количество страниц которое будет отображаться
	
	
if (isset($_GET['page'])){
    $page = $_GET['page'];
    if($page<1) {
		$page = 1;
	}
    else 
		if($page>$num_pages)
			$page = $num_pages;
}
else{
    $page = 1;
}



if ($products) {
	foreach ($products as $v) {			// выводим продукты
		
		$current_element++;

    	if(($current_element>($page*$max_post-$max_post)) && ($current_element<=$page*$max_post)){
						
			 $chet_str=0; ?>	
			 
		<div class="table_name"><strong> <?= $v['name'] ?></strong> 	</div>

		<table class='table_with_picture'>
			<tr>
				<td style='width: 250px; vertical-align:top;'>
					<img style='width: 200px;' src="/<?=$v['picture_url']?>">
				</td>
				
				<td style='vertical-align:top;'>
					<table id="customers" border="1" cellpadding="3" cellspacing="0">
						<tr>
						  <th style="text-align:center" >Название товара</th>
						  <th style="text-align:center">Размер</th>
						  <th style="text-align:center">Цена</th>
						  <th style="text-align:center; width:155px;">В корзину </th>
						</tr>			

					<?	foreach($v['kids'] as $s){
					
							$short_name=explode('(',$v['name']);
							$short_name=$short_name[0];		// короткое имя для вывода в таблице (без скобок)
							
					?>			

						<tr <? if($chet_str%2 == 0) echo 'class="alt"';?> >
							<td> <a href="/<?=$s['url']?>"> <?=$short_name?> </a> </td>		<!-- добавили ссылку на товар-->
							
							<td><?=$s['size']?></td>
							
							<td> договорная </td>

							<td style="padding:3px 4px;">
								<input  type="text" 
								class="add_input"
								onclick="this.select()"
								id="add_truby_<?=$s['id']?>" 
								value="1">

								<div class="product_buy" 
									onClick="location.href='/cart?in_cart_catalog_id=<?=$v['id_catalog']?>&in_cart_product_id=<?=$s['id']?>&in_cart_count='+ document.getElementById('add_truby_<?=$s['id']?>').value" 
									style="float:left; padding: 4px 20px;">
									В корзину
								</div>
							</td>
						</tr>
					<?
							$chet_str++;
						}
					?>	
					</table>
				</td>
			</tr>
		</table>
		
		
		
		
		<div style="clear:both"></div>
		<hr style="margin:20px 0;">		
<?	
		}
	}
}
?>   
 
 

<?	
	// вывод навигации по страницам
	
	$page_url = $_GET['route'];			// url для перехода на новую страницу
	if (!empty($_GET['page_size']))	
		$page_url = $page_url  . '?page_size=' . $max_post . '&page=';
	else
		$page_url = $page_url . '?page=';
?>

<div class="pages_block">

<?
if ($num_pages > 2) {

	if ($page == 1) {
?>				
		<div class="navigation_big_button">		<a href='/<?=$page_url?>1'> Первая </a>						</div>
		<div class="navigation_push">			<a href='/<?=$page_url?>1'> 1 </a>							</div>
		<div class="navigation">				<a href='/<?=$page_url?>2'> 2 </a>							</div>		
		<div class="navigation">				<a href='/<?=$page_url?>3'> 3 </a>							</div>
		<div class="navigation_big_button">		<a href='/<?=$page_url?><?=$num_pages ?> '>  Последняя </a>	</div>
<?	
	}
	
	if ($page > 1 && $page < $num_pages) {
?>
		<div class="navigation_big_button">	<a href='/<?=$page_url?>1'> Первая </a>						</div>		
		<div class="navigation">			<a href='/<?=$page_url?><?=$page-1?>'> <?=$page-1?> </a>	</div>	
		<div class="navigation_push">		<a href='/<?=$page_url?><?=$page?>'> <?=$page?> </a>		</div>		
		<div class="navigation">			<a href='/<?=$page_url?><?=$page+1?>'> <?=$page+1?> </a>  	</div>
		<div class="navigation_big_button">	<a href='/<?=$page_url?><?=$num_pages ?> '>  Последняя </a>	</div>				
<?
	}
					
	if($page == $num_pages){
?>
		<div class="navigation_big_button">	<a href='/<?=$page_url?>1'> Первая </a>						</div>		
		<div class="navigation">			<a href='/<?=$page_url?><?=$page-2?>'> <?=$page-2?> </a>	</div>	
		<div class="navigation">			<a href='/<?=$page_url?><?=$page-1?>'> <?=$page-1?> </a>	</div>		
		<div class="navigation_push">		<a href='/<?=$page_url?><?=$page?>'> <?=$page?> </a>		</div>
		<div class="navigation_big_button">	<a href='/<?=$page_url?><?=$num_pages ?> '>  Последняя </a>	</div>	
<?
	}				
}
else 
	if($num_pages == 2) {
		if($page == 1){
?>
			<div class="navigation_big_button">	<a href='/<?=$page_url?>1'> Первая </a>						</div>		
			<div class="navigation_push">		<a href='/<?=$page_url?>1'> 1 </a>							</div>	
			<div class="navigation">			<a href='/<?=$page_url?>2'> 2 </a>							</div>		
			<div class="navigation_big_button">	<a href='/<?=$page_url?><?=$num_pages ?> '>  Последняя </a>	</div>
<?
		}
		else {
?>
			<div class="navigation_big_button">	<a href='/<?=$page_url?>1'> Первая </a>						</div>		
			<div class="navigation">		<a href='/<?=$page_url?>1'> 1 </a>								</div>	
			<div class="navigation_push">			<a href='/<?=$page_url?>2'> 2 </a>						</div>		
			<div class="navigation_big_button">	<a href='/<?=$page_url?><?=$num_pages ?> '>  Последняя </a>	</div>
<?
		}
	}
?>
</div>
