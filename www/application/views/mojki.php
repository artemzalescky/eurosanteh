<?
		$url="";
		$arr_eng=explode('/',$_GET['route']);
		
		$full_url=$_GET['route'];	// с параметрами (для перелистывания страниц )
	?>
		<div id="catalog_tree">
	<?	
		foreach($arr_eng as $i => $u){
			$url=$url."/".$u;?>
			<a href=" <?=$url?>"><div class="item_of_tree"> <?=$rus_names[$i]?>  </div> </a>
			
	<?	
			if($i<count($arr_eng)-1){
	?>
				<div><img src="/images/next2.png"> </div>
	<?		
			}
		}
	?>
		</div>
	<div style="clear:both"></div>



<div class="podkatalogs">
<?php 
if($subs!=0)
foreach($subs as $sub){ ?>		
	<figure class="sign">
	    <a href="/<?=$_GET['route']?>/<?=$sub['name']?>"> <div> <img src="/images/<?=$_GET['route']?>/<?=$sub['name']?>.jpg"> </div> </a>
	   <figcaption style="text-align:center"> <a href="/<?=$_GET['route']?>/<?=$sub['name']?>"> <?=$sub['name_rus']?> </a> </figcaption>
  </figure>	
	<?
}
?>
</div>
<div style="clear:both"></div>


<table width="100%" cellpadding="0" cellspacing="0">
 <tbody>
 	<tr valign="top">
	 <td>
	 <span class="1" style="margin-top:4px; float:left">Выводить по: </span>
	 	<form class="1" method="get">
			<select name="page_size" onChange="this.form.submit();" style="padding:2px; margin-left:10px;">
				<option value = "20" > 20 </option>
				<option value = "40" <?if($_GET['page_size']==40) echo "selected=\"selected\"";?>> 40 </option>
				<option value = "60" <?if($_GET['page_size']==60) echo "selected=\"selected\"";?>> 60 </option>
			</select>
		</form>
	 </td>
	</tr>
 </tbody>
</table>
<?php

	if(!isset($_GET['page_size'])){
	$max_post = 20;
	}
	else {
	$max_post = $_GET['page_size'];	
	}
	
   // $max_post = 20; //максимальное количество постов на странице
   // $max_post = 20; //максимальное количество постов на странице
    $num_post = count($products); //количество постов всего


    $num_pages = intval(($num_post-1)/$max_post) +1;   //количество страниц которое будет отображаться
	

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


$current_element=0;
foreach($products as $item)
	{
    $current_element++;

    	if(($current_element>($page*$max_post-$max_post)) && ($current_element<=$page*$max_post)) {		
?>
			
								<div class="product">

									<div class="product_image" style="height:170px;">
										<a href="/product?id_catalog=mojki&id_product=<?=$item['id']?>"> 	
										<image src="/images/mojki/<?=$item["photo_name"]?>.jpg"> </a>									
									</div>
									
									<div class="product_name_in_list_container">
										<div class="product_name_in_list">		<!-- будет посередине контейнера имени -->
											<a href="/product?id_catalog=mojki&id_product=<?=$item['id']?>">
												<h2><?=$item["name"]?></h2>
											</a> 
										</div>
									</div>	
																	
									<div class="product_price">
											<div>
												<span>Цена договорная</span>										
											</div>
									</div>	

									<div class="product_buy" onClick="location.href='/cart?in_cart_catalog_id=mojki&in_cart_product_id=<?=$item['id']?>'">
										В корзину
									</div>

									
								</div>	
						
					
				<?
		}
	
}       

?>


<div style="clear:both"></div>
<hr style="margin-bottom:20px;">
   
 

<div class="block">
<?

 if ($num_pages > 2){
		  
					if($page == 1 ){
?>				<div class="navigation_big_button">	   <a href='/$full_url?page_size=<?=$max_post?>&page=1'> Первая </a>		</a>	</div>
				<div class="navigation_push">		<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?=$page?>'> <?=$page?> </a>			</div>
				<div class="navigation">		<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?= ($page=$page+'1') ?>'> <?= $page ?></a>	</div>		
				<div class="navigation">		<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?= ($page=$page+'1') ?>'> <?= $page ?></a>	</div>
				<div class="navigation_big_button">		<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?=$num_pages ?> '>  Последняя </a></br>		</div>
						<? $page=1;	
					} 
					
					if ($page == 2){
						$page = $page-1; ?>
			<div class="navigation_big_button">				<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=1'> Первая </a>		</a>	</div>		
			<div class="navigation">			<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?=$page?>'> <?=$page?> </a>			</div>	
			<div class="navigation_push">			<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?= ($page=$page+'1') ?>'> <?= $page ?></a>	</div>		
			<div class="navigation">			<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?= ($page=$page+'1') ?>'> <?= $page ?></a>  </div>
		<div class="navigation_big_button">	    <a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?=$num_pages ?> '>  Последняя </a></br> </div>
						<? 
						$page = 2;
					}  
					
					if ($page > 2 && $page < $num_pages){
						$page = $page-1;
						$f = $page-2; 
						
						?>
<div class="navigation_big_button">				<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=1'> Первая </a>		</a></div>
<div class="navigation">						<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?=$page?>'> <?=$page?> </a>		</div>				
<div class="navigation_push">						<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?= ($page=$page+'1') ?>'> <?= $page ?></a>	</div>		
<div class="navigation">						<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?= ($page=$page+'1') ?>'> <?= $page ?></a>	</div>
<div class="navigation_big_button">				<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?=$num_pages?>'>  Последняя </a></br>		</div>
						
						<? $page = $num_pages - 1; 
					}
					
					if($page == $num_pages){
						$page = $page - 2;
						?>
	<div class="navigation_big_button">					<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=1'> Прервая </a>			</div>
	<div class="navigation">					<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?=$page?>'> <?= $page ?> </a>		</div>					
	<div class="navigation">					<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?= ($page=$page+'1') ?>'> <?= $page ?></a>	</div>		
	<div class="navigation_push">					<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?= ($page=$page+'1') ?>'> <?= $page ?></a>	</div>
	<div class="navigation_big_button">				<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=<?=$num_pages?>'>  Последняя </a></br>		</div>
						<?
					}			

		
}
else if($num_pages == 2)
		{ 
		if($page == 1){
		?>
		<div class="navigation_big_button">				<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=1'> Первая </a> </div>
		<div class="navigation_push">  <a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=1'> 1 </a>	</div>				
		<div class="navigation">  <a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=2'> 2 </a>   </div>
		<div class="navigation_big_button">				<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=2'> Последняя </a>		</div>
		<?
		}		
		else {  ?>
		<div class="navigation_big_button">				<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=1'> Первая </a> </div>
		<div class="navigation">  <a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=1'> 1 </a>	</div>				
		<div class="navigation_push">  <a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=2'> 2 </a>   </div>
		<div class="navigation_big_button">				<a href='/<?=$full_url?>?page_size=<?=$max_post?>&page=2'> Последняя </a>		</div>
		<?
		}
}
	?>

	
</div>


