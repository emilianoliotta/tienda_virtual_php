<?php
  function paginate_products($currentPage, $search = NULL, $categoryID = NULL, $order_by, $order){
    include_once("product_class.php");

    if (!(isset($currentPage) && is_numeric($currentPage))) {
       $currentPage = 1;
    }if ($currentPage < 1) {
       $currentPage = 1;
    }
    $rowsPerPage = Product::ROWS_PER_PAGE;
    $offset = ($currentPage - 1) * $rowsPerPage;

    $searchParameter = ($search == NULL) ? "" : $search;
    $result = Product::getProducts($searchParameter, $categoryID, $order_by, $order, $offset, $rowsPerPage);

    $rowsAmount = Product::getRowsAmount($searchParameter, $categoryID);
    $pagesAmount = ceil($rowsAmount / $rowsPerPage);

    $results = array('products' => $result, 'pagesAmount' => $pagesAmount);
    return $results;
  }
?>
