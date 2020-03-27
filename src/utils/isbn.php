<?php
function isValidISBN13(string $isbn) bool {
  return preg_match('#\\d{3}-\\d-\\d{3}-\\d{5}-\\d#', $isbn);
}
?>
