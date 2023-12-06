<!doctype html>
<html lang="ru">
    <head>
	    <div class="header">
			<title>Комендант 221-362 ЛБ11</title>
			<div class="header-item" id="title-item">
				<div class="nav-title"><h1>Таблица умножения</h1></div>
			</div>
			<div class="header-item">
				<div class="main_menu">
					<?php
						echo '<a href="?html_type=TABLE';
						if(isset($_GET['content']) )
							echo '&content='.$_GET['content'];
						echo '"';
						if( array_key_exists('html_type', $_GET) && $_GET['html_type']== 'TABLE' )
							echo ' class="selected"';
						echo '>Табличная форма</a>';

						echo '<a href="?html_type=DIV';
						if(isset($_GET['content']) )
							echo '&content='.$_GET['content'];
						echo '"';
						if( array_key_exists('html_type', $_GET) && $_GET['html_type']== 'DIV' )
							echo ' class="selected"';
						echo '>Блочная форма</a>';
					?>
				</div>
			</div>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<link rel="stylesheet" href="index.css"/>
			<link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
		</div>
	</head>
	<body>
	    <div class="sidebar">
			<div id="product_menu">
				<?php
					echo '<a href="?';
					if(isset($_GET['html_type']))
							echo 'html_type='.$_GET['html_type'].'"';
					else
						echo '"';
					if(!isset($_GET['content']))
						echo ' class="selected"';
					echo '>Вся таблица умножения</a>';
					for($i=2; $i<=9; $i++){
						echo '<a href="?';
						if(isset($_GET['html_type']))
							echo 'html_type='.$_GET['html_type'].'&';
						echo 'content='.$i. '" ';
						if(isset($_GET['content']) && $_GET['content']==$i)
							echo ' class="selected"';
						echo '>Таблица умножения на '.$i.'</a>';
					}
				?>
			</div>
		</div>
		<div class="main">
		<?php
			if (!isset($_GET['html_type']) || $_GET['html_type']== 'TABLE' )
				outTableForm();
			else
				outDivForm();
		?>
		</div>
	</body>
	<?php
		session_start();
		$format = "";
		$table_name = "";
		$data = "";
		if( !isset($_GET['html_type']) || $_GET['html_type']== 'TABLE' )
			$format='Табличная верстка. ';
		else
			$format='Блочная верстка. ';
		if( !isset($_GET['content']) )
			$table_name.='Таблица умножения полностью. ';
		else
			$table_name='Столбец таблицы умножения на '.$_GET['content']. '. ';
		date_default_timezone_set('Europe/Moscow');
		$data = date('d.Y.M h:i:s'); 
	?>
	<footer>
	    <div class="footer-container">
		    <div class="footer-item">
			    <h3>О сайте</h3>
				<a>Данная страница является результатом 11 лабораторной работой (Веб-технологии)</a>		
			</div>
			<div class="footer-item">
				<h3>Дата</h3>
				<div id="data"><?php echo $data ?></div> 
			</div>
			<div class="footer-item">
				<h3>Формат</h3>
				<a><?php echo $format ?></a> 
			</div>
			<div class="footer-item">
				<h3>Название таблицы</h3>
				<a><?php echo $table_name ?></a> 
			</div>
			<div class="footer-item">
			    <h3>Контакты</h3>
			    <ul class="footer-ul">
				    <li><a href="">maks.komendant@yandex.ru</a></li>
					<li><a>+79259257991</a>	</li>
				</ul>
			</div>
		</div>
	</footer>
</html>

<?php
function outDivForm (){
	echo '<div class="main-container">';
	if(!isset($_GET['content'])){
		for($i=2; $i<10; $i++){
			echo '<div class="ttRow">';
			outRow( $i );
			echo '</div>';
		}
	}else{
		echo '<div class="ttSingleRow">';
		outRow( $_GET['content'] );
		echo '</div>';
	}
	echo '</div>';
} 
function outTableForm (){
	echo '<table>';
	if(!isset($_GET['content'])){
		echo '<tr class="ttRow">';
		for($i=2; $i<10; $i++){
			echo '<td>';
			outRow( $i );
			echo '</td>';
		}
		echo '</tr>';
	}else{
		echo '<tr class="ttSingleRow">';
		echo '<td>';
		outRow( $_GET['content'] );
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';
} 



function outRow ( $n ){
	for($i=2; $i<=9; $i++){
		echo outNumAsLink($n);
		echo '<a> x</a>';
		echo outNumAsLink($i);
		echo '<a>=</a>';
		echo outNumAsLink($i*$n).'<br>';
	}
}
function outNumAsLink($x){
	if( $x<=9 )
		echo '<a href="?content='.$x. '"> '.$x.'</a>';
	else
		echo $x;
} 
?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
	setInterval(function(){
	$.ajax({url: "data.php", success: function(response){
		$('#data').html(response)
	}});
	}, 1000);
</script>