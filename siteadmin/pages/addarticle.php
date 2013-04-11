<?php
if(!defined('IN_STORE')) die(); //Si ca doit être un fichier inclut

if($account->getConnected())
{
	$smarty->assign('conected', true);
	
	$name = (isset($_POST['name']))?$_POST['name']:'';

	$referency = (isset($_POST['referency']))?$_POST['referency']:'';

	$date = (isset($_POST['date']))?$_POST['date']:'';

	$TVA = (isset($_POST['TVA']))?$_POST['TVA']:0;

	$price = (isset($_POST['price']))?$_POST['price']:0;

	$category = (isset($_POST['category']))?$_POST['category']:'';

	$subcategory = (isset($_POST['subcategory']))?$_POST['subcategory']:'';

	$description = (isset($_POST['description']))?$_POST['description']:'';

	$quantityDisponible = (isset($_POST['quantitydisponible']))?intval($_POST['quantitydisponible']):0;

	$quantityAlert = (isset($_POST['quantityalert']))?intval($_POST['quantityalert']):0;

	$authors = (isset($_POST['authors']))?$_POST['authors']:'';

	$actors = (isset($_POST['actors']))?$_POST['actors']:'';

	$keyWords = (isset($_POST['keywords']))?$_POST['keywords']:'';
	
	
	$smarty->assign('created', false);
	
	if( !empty($name) && !empty($referency) && !empty($date) && $TVA > 0 && $price > 0 && !empty($category) && !empty($subcategory) && !empty($description) && $quantityDisponible >=0 && $quantityAlert > 0 && !empty($authors) && !empty($actors) && !empty($keyWords) ) 
	{
		$smarty->assign('not_all_value_founded', false);
		
		$article = new ArticleAdmin;
		if($article->add($name, $referency, $category, $subcategory, $date, $quantityDisponible, $quantityAlert, $price, $TVA, $description, $authors, $actors, $keyWords))
		{
			$smarty->assign('created', true);
		}
		else
		{
			$smarty->assign('created', false);
		}
	}
	else
	{
		$smarty->assign('not_all_value_founded', true);
	}
	
}
else
{
	$smarty->assign('conected', false);
}

?>
