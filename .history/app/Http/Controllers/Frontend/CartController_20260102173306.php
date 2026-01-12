
<?php

// The class CartController cannot be redeclared due to a name collision.
// This file should not declare CartController again.

http_response_code(500);
echo "Error: Cannot declare class CartController, because the name is already in use.";

exit;
