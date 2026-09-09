<?php
if (isset($_POST['submit']) && !empty($_FILES['folder_files']['name'][0])) {
    
    $zip = new ZipArchive();
    $zipFileName = "compressed_folder_" . time() . ".zip";

    // ZipArchive::CREATE फ्लैग से नई ज़िप फाइल ऑफलाइन बनती है
    if ($zip->open($zipFileName, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        
        $files = $_FILES['folder_files'];
        
        // लूप चलाकर सभी फाइल्स को ज़िप में जोड़ें
        foreach ($files['tmp_name'] as $index => $tmpName) {
            if ($files['error'][$index] === UPLOAD_ERR_OK) {
                
                // वर्ल्डस्किल्स का नियम: खाली सबफ़ोल्डर्स नहीं आने चाहिए
                // 'name' एट्रीब्यूट में फाइल का पूरा पाथ (e.g., folder/sub/file.txt) होता है
                $relativeFilePath = $files['name'][$index]; 
                
                // अस्थायी पाथ से फाइल को ज़िप आर्काइव में उसका स्ट्रक्चर बनाए रखते हुए डालें
                $zip->addFile($tmpName, $relativeFilePath);
            }
        }
        
        $zip->close();

        // फाइल को तुरंत यूज़र के ब्राउज़र पर डाउनलोड कराने के लिए हेडर्स
        if (file_exists($zipFileName)) {
            header('Content-Type: application/zip');
            header('Content-Disposition: attachment; filename="' . basename($zipFileName) . '"');
            header('Content-Length: ' . filesize($zipFileName));
            
            flush(); // सिस्टम बफ़र को साफ़ करें
            readfile($zipFileName);
            
            unlink($zipFileName); // डाउनलोड के बाद सर्वर से ज़िप डिलीट करें (Memory Cleanup)
            exit;
        }
    } else {
        die("Failed to create ZIP file.");
    }
} else {
    die("No files selected.");
}
?>
