<?php 
// 1. किसी भी ओरिजिन/पोर्ट (जैसे फ्रंट-एंड का dev server) से रिक्वेस्ट स्वीकार करें
header("Access-Control-Allow-Origin: *");

// 2. सभी आवश्यक HTTP मेथड्स (GET, POST, PUT, DELETE) और Preflight (OPTIONS) को अनुमति दें
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// 3. फ्रंट-एंड से आने वाले सभी स्टैंडर्ड और कस्टम हेडर्स को अनुमति दें
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// 4. Preflight (OPTIONS) रिक्वेस्ट के लिए तुरंत 200 OK रिस्पॉन्स देकर स्क्रिप्ट रोकें
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}
