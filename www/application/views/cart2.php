
<div id="cart">

	<h2 id="cart_title" style="margin-left:50px;">Оформление заказа</h2>

<table>			
    <tbody><tr>
        <td width="50%"></td>
        <td width="900" align="center">           
        </td>
        <td width="50%"></td>
    </tr>
    <tr>
        <td width="1000" style="padding-left:300px;"> 
            <form name="feedBack" action="mail.php" method="post">
                <p class="formLabel">Ваше имя</p>
				<div style="padding-top:10px;"></div>
                <input type="text" value="" name="fn" class="text" id="userName">
                <div class="error"></div>
                <br>
				
                <p class="formLabel">Ваш номер телефона</p>
				<div style="padding-top:10px;"></div>
                <input type="text" value="" name="phone" class="text" id="phoneNumber">
                <div class="error"></div>
                <br>
				
				<p class="formLabel">Ваш адрес</p>
				<div style="padding-top:10px;"></div>
                <input type="text" value="" name="address" class="text" id="address">
                <div class="error"></div>
                <br>
				<input type="submit" id="name_button" value = "Подтверждение">
				<div class="error"></div>
                <br>
                
            </form>
        </td>
        <td width="50%"></td>
    </tr>

</tbody></table>


</div>