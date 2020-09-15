<?php
 $i1 = "Orange/cinnamon";
 $i2 = "Wild berry";
 $i3 = "Peppermint";
 $i4 = "Earl grey";
 $i5 = "Lady grey ";
 $i6 = "Lavender";
 $i7 = "English breakfast";
 /*$p1 = 6;
 $p2 = 6;
 $p3 = 6;
 $p4 = 6;
 $p5 = 16;
 $p6 = 17;*/

 for($n=1;$n<;$n++) {
	 $t="i".$n;
	 $p="p".$n;
	 echo "INSERT food_catalogue VALUE(\"\",\"".$$t."\",".$$p.",7);<br/>";
 }
 
 $sql1 = "select s.food_id,s.cata_name as food_name,s.price,p.cata_name from food_catalogue as s join food_catalogue as p where p.food_id = s.catalog_id and s.price !=\"NULL\";"; //查询结构及其价格
 $sql2 = "select catalog_id,cata_name from food_catalogue where food_id < 11;";   //查询大类
 
 $sql3 = "SELECT item_id,f.order_id,cus.firstname as customer,Cs.cata_name as food_name,Cp.cata_name,quantity,Cs.price as Single_Price,(Cs.price*quantity)as Total_Price,date,time from order_food as F JOIN orders as O on F.order_id = O.order_id JOIN food_catalogue as Cs ON F.food_id = Cs.food_id JOIN food_catalogue as Cp ON Cp.food_id = Cs.catalog_id JOIN customer_info as cus ON cus.customer_id = o.customer_id;"  //显示订单所有食物购买信息
 $SQL4 = "select Order_id,firstname as Customer,Order_Price,Date,Time from orders as o inner join customer_info as c ON o.customer_ID = c.customer_id;";
     //显示所有订单
	 "where o.date =(select current_date);"  //显示今日
	 "where DATE_SUB(CURDATE(), INTERVAL 7 DAY) <= date;" //显示7天内
	 "select c.cata_name as food_name,cs.cata_name,quantity from orders as o join order_food as f ON f.order_id = o.order_id join food_catalogue as c ON c.food_id = f.food_id join food_catalogue as cs ON c.catalog_id = cs.food_id where o.date =(select current_date);" //统计today各个商品销售量，但有重复
	 
	"where month(date) = 11" //specific month
	"where week(date,1) = 1"  //specific week
 $sql5 = "select s.cata_name as food_name,s.price from food_catalogue as s where S.catalog_id = 1 and s.price !=\"NULL\";";
 
 
 $sql= UPDATE c_i SET credit = (select sum(order_price) from o_s where customer_id= 150002) where customer_id= 150002;
 ?>
 
