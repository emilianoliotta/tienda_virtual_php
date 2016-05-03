<?php
function paginate_products($currentPage, $search = NULL, $categoryID = NULL){
  include_once("product_class.php");

  if (!(isset($currentPage) && is_numeric($currentPage))) {
     $currentPage = 1;
  }if ($currentPage < 1) {
     $currentPage = 1;
  }
  $rowsPerPage = Product::ROWS_PER_PAGE;
  $offset = ($currentPage - 1) * $rowsPerPage;

  if ($search != NULL){
			if ($categoryID != NULL){
				$result = Product::getProductsForSearch($search, $categoryID, $offset, $rowsPerPage);
			}else{
				$result = Product::getProductsForSearch($search, NULL, $offset, $rowsPerPage);
			}
	}else {
		if ($categoryID != NULL){
			$result = Product::getProducts($categoryID, $offset, $rowsPerPage);
		}else{
			$result = Product::getProducts(NULL, $offset, $rowsPerPage);
		}
	}
  
  $rowsAmount = Product::getRowsAmount($search, $categoryID);
  $pagesAmount = ceil($rowsAmount / $rowsPerPage);

  $results = array('products' => $result, 'pagesAmount' => $pagesAmount);
  return $results;
}
?>
