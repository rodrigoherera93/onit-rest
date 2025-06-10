<?php
// onit-rest/config.php

// Database Credentials
define('DB_HOST', 'your_db_host'); // Database host (e.g., localhost)
define('DB_NAME', 'your_db_name'); // Database name
define('DB_USER', 'your_db_user'); // Database username
define('DB_PASS', 'your_db_password'); // Database password

// API Keys
define('WISPRO_API_KEY', 'your_wispro_api_key'); // WISPRO API Key
define('FEL_COFIDI_USER', 'your_cofidi_user'); // FEL COFIDI User
define('FEL_COFIDI_PASSWORD', 'your_cofidi_password'); // FEL COFIDI Password
define('RECURRENTE_API_KEY', 'your_recurrente_api_key'); // RECURRENTE API Key
define('SERVINSA_API_USER', 'your_servinsa_api_user'); // SERVINSA API User
define('SERVINSA_API_PASSWORD', 'your_servinsa_api_password'); // SERVINSA API Password
define('AMY_API_KEY', 'your_amy_api_key'); // AMY SMS API Key

// Other Constants
define('LOG_FILE_PATH', __DIR__ . '/app.log'); // Path to the log file
define('BASE_URL', 'http://localhost/onit-rest'); // Base URL of the application

// Timezone Setting
date_default_timezone_set('America/Guatemala'); // Set your desired timezone
?>
