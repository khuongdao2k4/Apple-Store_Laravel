<?php
$f = 'resources/views/pages/order.blade.php';
$lines = file($f);

$tradeInStart = -1;
$appleCareEnd = -1;
$leftColEnd = -1;

for ($i = 0; $i < count($lines); $i++) {
    if (strpos($lines[$i], '<h3><strong>Apple Trade In.</strong>') !== false) {
        $tradeInStart = $i;
    }
    if (strpos($lines[$i], 'document.getElementById(\'applecare-modal\').addEventListener(\'click\', function(e) {') !== false) {
        // The end is a few lines after this
        $appleCareEnd = $i + 3; // +1 for if, +2 for });, +3 for </script>
    }
    if (strpos($lines[$i], '<div class="rf-bfe-column-right">') !== false) {
        // Left column ends right before this
        $leftColEnd = $i - 1; 
        // actually let's find the </div> that closes rf-bfe-column-left.
        // It's the </div> right before <div class="rf-bfe-column-right">
    }
}

// Ensure we found them
if ($tradeInStart != -1 && $appleCareEnd != -1) {
    // Extract Trade In and AppleCare
    $tia = array_slice($lines, $tradeInStart, $appleCareEnd - $tradeInStart + 1);
    
    // Remove them from the original array
    array_splice($lines, $tradeInStart, $appleCareEnd - $tradeInStart + 1);
    
    // Now we need to find where to insert them.
    // We want to insert them right before the </div> that closes rf-bfe-column-left.
    // Let's find <div class="rf-bfe-column-right"> in the NEW $lines array.
    $insertPos = -1;
    for ($i = 0; $i < count($lines); $i++) {
        if (strpos($lines[$i], '<div class="rf-bfe-column-right">') !== false) {
            // we want to insert right before the </div> that precedes this.
            // let's look backwards for </div>
            for ($j = $i - 1; $j >= 0; $j--) {
                if (strpos($lines[$j], '</div>') !== false) {
                    $insertPos = $j;
                    break;
                }
            }
            break;
        }
    }
    
    if ($insertPos != -1) {
        array_splice($lines, $insertPos, 0, $tia);
        file_put_contents($f, implode('', $lines));
        echo "Successfully moved Trade In and AppleCare back to left column.\n";
    } else {
        echo "Could not find insert position.\n";
    }
} else {
    echo "Could not find Trade In or AppleCare sections.\n";
}
?>
