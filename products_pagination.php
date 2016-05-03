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

    $searchParameter = ($search == NULL) ? "" : $search;
    #$categoryParameter = ($categoryID == '0') ? NULL : $categoryID;
    $categoryParameter = $categoryID;
    $result = Product::getProducts($searchParameter, $categoryParameter, $offset, $rowsPerPage);

    $rowsAmount = Product::getRowsAmount($searchParameter, $categoryParameter);
    $pagesAmount = ceil($rowsAmount / $rowsPerPage);

    $results = array('products' => $result, 'pagesAmount' => $pagesAmount);
    return $results;
  }
?>
