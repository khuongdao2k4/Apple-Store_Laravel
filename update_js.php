<?php
$file = 'resources/views/pages/order.blade.php';
$content = file_get_contents($file);

$old = '    function updateSummary() {
        if (!currentModel || !currentStorage) return;
        
        const finalPrice = currentModel.price + currentStorage.priceOffset + appleCarePrice;
        const monthlyPrice = Math.round(finalPrice / 24);

        // Headline: "iPhone 16e 512GB"
        document.getElementById(\'summary-product-headline\').innerText =
            `${currentModel.name} ${currentStorage.name}`;

        // Total & monthly
        document.getElementById(\'summary-total-price\').innerText = formatCurrency(finalPrice);
        document.getElementById(\'summary-monthly-price\').innerText = formatCurrency(monthlyPrice);
        
        // Update hidden inputs for submission
        document.getElementById(\'input-product-name\').value = currentModel.name;
        document.getElementById(\'input-total-price\').value = finalPrice;
        document.getElementById(\'input-storage\').value = currentStorage.name;
        document.getElementById(\'input-color\').value = currentColor;
        document.getElementById(\'input-image\').value = currentModel.image;
    }';

$new = '    function updateSummary() {
        if (!currentModel || !currentStorage) return;
        
        const finalPrice = currentModel.price + currentStorage.priceOffset + appleCarePrice;
        const monthlyPrice = Math.round(finalPrice / 24);
        const downPayment = Math.round(finalPrice * 0.20);
        const taxEstimate = Math.round(finalPrice * 8 / 108);

        // Headline: "iPhone 16e 512GB"
        document.getElementById(\'summary-product-headline\').innerText =
            `${currentModel.name} ${currentStorage.name}`;

        // Total & monthly
        document.getElementById(\'summary-total-price\').innerText = formatCurrency(finalPrice);
        document.getElementById(\'summary-monthly-price\').innerText = formatCurrency(monthlyPrice);

        // Down payment & tax
        document.getElementById(\'summary-down-payment\').innerText = formatCurrency(downPayment);
        document.getElementById(\'summary-tax\').innerText = formatCurrency(taxEstimate);
        
        // Update hidden inputs for submission
        document.getElementById(\'input-product-name\').value = currentModel.name;
        document.getElementById(\'input-total-price\').value = finalPrice;
        document.getElementById(\'input-storage\').value = currentStorage.name;
        document.getElementById(\'input-color\').value = currentColor;
        document.getElementById(\'input-image\').value = currentModel.image;
    }';

if (strpos($content, $old) !== false) {
    $content = str_replace($old, $new, $content);
    file_put_contents($file, $content);
    echo "SUCCESS: updateSummary updated!\n";
} else {
    echo "ERROR: Could not find target.\n";
    // Find the updateSummary function
    $pos = strpos($content, 'function updateSummary()');
    if ($pos !== false) {
        echo "Found at char $pos:\n";
        echo substr($content, $pos, 500);
    }
}
