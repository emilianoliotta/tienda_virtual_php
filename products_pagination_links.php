<?php
  function generate_pagination_links($pagesAmount, $currentPage, $search = NULL, $categoryID = NULL){

    // Rango de números de links a mostrar
    $range = 3;

    // Manejo de parámatros de URL
    $categoryParameter = ($categoryID != NULL) ? "&idCategoriaProducto=" . $categoryID : "";
    $searchParameter = ($search != NULL) ? "&search-data=" . $search . "&search=" : "";

    if (!(isset($currentPage) && is_numeric($currentPage))) {
       $currentPage = 1;
    }
    if ($currentPage > $pagesAmount) {
       $currentPage = $pagesAmount;
    }
    if ($currentPage < 1) {
       $currentPage = 1;
    }

    if ($currentPage > 1) {
       echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=1". $categoryParameter . $searchParameter . "' class='btn btn-success btn-sm'><<</a> ";
       $previousPage = $currentPage - 1;
       echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$previousPage". $categoryParameter . $searchParameter . "' class='btn btn-success btn-sm'><</a> ";
    }

    for ($index = ($currentPage - $range); $index < (($currentPage + $range) + 1); $index++) {
       if (($index > 0) && ($index <= $pagesAmount)) {
          if ($index == $currentPage) {
             echo " <button class='btn btn-info btn-sm btn-disabled' disabled>$index</button> ";
          } else {
             echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$index". $categoryParameter . $searchParameter . "' class='btn btn-info btn-sm'>$index</a> ";
          }
       }
    }

    if ($currentPage != $pagesAmount) {
       $nextPage = $currentPage + 1;
       echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$nextPage". $categoryParameter . $searchParameter . "' class='btn btn-success btn-sm'>></a> ";
       echo " <a href='{$_SERVER['PHP_SELF']}?currentPage=$pagesAmount". $categoryParameter . $searchParameter . "' class='btn btn-success btn-sm'>>></a> ";
    }
  }
?>
