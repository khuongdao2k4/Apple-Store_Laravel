<?php
include_once '../app/config/database.php'; // Đảm bảo kết nối CSDL

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    die("Lỗi: Không tìm thấy ID sản phẩm.");
}

$id = intval($_GET["id"]); // Chuyển ID thành số nguyên để tránh lỗi SQL Injection

$sql = "SELECT name, image_url, colors, price FROM products WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id); // Liên kết ID với câu truy vấn SQL
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $product = $result->fetch_assoc();
} else {
    die("Lỗi: Không tìm thấy sản phẩm.");
}

$stmt->close();
?>
<script>
    const username = "<?php echo isset($_SESSION['user_name']) ? $_SESSION['user_name'] : ''; ?>";
    const email = "<?php echo isset($_SESSION['email']) ? $_SESSION['email'] : ''; ?>";
</script>


<?php
$pageTitle = "order-test.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<div class="deals-container">
        <div class="deal-info">
            <strong style="font-size:13px;">Carrier Deals at Apple</strong><br>
            <a href="#" class="see-all">See all deals ➕</a>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-att?wid=24&hei=24&fmt=png-alpha&.v=1658193314821"
                alt="Carrier 1">
            <span>Save up to $1000 after trade-in.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-lightyear?wid=24&hei=24&fmt=png-alpha&.v=1724793407797"
                alt="Carrier 2">
            <span>Save up to $1000. No trade-in needed.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-tmobile?wid=24&hei=24&fmt=png-alpha&.v=1658193314615"
                alt="Carrier 3">
            <span>Save up to $1000 after trade-in.</span>
        </div>
        <div class="deal-item">
            <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/desktop-bfe-iphone-step1-bugatti-banner-verizon?wid=24&hei=24&fmt=png-alpha&.v=1725054383893"
                alt="Carrier 4">
            <span>Save up to $1000 after trade-in.</span>
        </div>
    </div>

    <div class="purchase-container">
        <div>
            <h1 style="font-size: 48px; font-weight: bold;"><?php echo 'Buy ' . htmlspecialchars($product["name"]); ?>
            </h1>
            <p style="font-size: 17px;">From $999 or $41.62/mo. for 24 mo.*</p>
            <div class="apple-intelligence">
                <img src="https://store.storeimages.cdn-apple.com/4982/as-images.apple.com/is/iphone-selector-icon-apple-intelligence-202409?wid=17&hei=21&fmt=p-jpg&qlt=95&.v=1724970464935"
                    alt="Apple Intelligence">
                <span>Apple Intelligence<sup>8</sup></span>
            </div>
        </div>
        <div class="offer-buttons">
            <button class="offer-button" style="width:300px; margin-left: 50px; ">Get $40–$630 for your trade-in.
                ➕</button>
            <button class="offer-button">Get 3% Daily Cash back with Apple Card. ➕</button>
        </div>
    </div>


    <div class="rf-bfe-main row">
        <div class="rf-bfe-column-left">

            <img src="<?php echo htmlspecialchars($product["image_url"]); ?>" alt="Product Image"
                style="max-width: 100%; height: auto; object-fit: contain; padding-bottom: 50px;">

            <h3><strong>Apple Trade In.</strong> Get $40–$630 credit toward your new iPhone.</h3>
            <div class="trade-options">
                <div class="trade-card" style="font-size: 19px;">Select a smartphone<br><small
                        style="font-size: 12px; font-weight: lighter;">Answer a few questions to get your
                        estimate.</small></div>
                <div class="trade-card" style="font-size: 19px;">
                    <p style="padding-top: 12px;">No trade-in</p>
                </div>
            </div>

            <h3><strong>Payment options.</strong> Select the one that works for you.</h3>
            <div class="payment-options">
                <div class="payment-card"><strong>Buy</strong>
                    <p>Pay with Apple Pay or other payment methods.</p>
                </div>
                <div class="payment-card"><strong>Finance</strong>
                    <p>Pay over time at 0% APR.</p>
                </div>
                <div class="payment-card"><strong>Apple iPhone Upgrade Program</strong>
                    <p>Pay monthly at 0% APR with the option to upgrade to a new iPhone every year.</p>
                </div>
            </div>
        </div>
        <div class="rf-bfe-column-right">
            <h2><strong>Model.</strong> Which is best for you?</h2>

            <div class="model-card">
                <div style="width:60%">
                    <strong><?php echo htmlspecialchars($product["name"]); ?> </strong>
                    <p>6.3-inch display</p>
                </div>
                <div style="width:40%">
                    <p> <?php echo 'From ' . htmlspecialchars($product["price"]); ?></p>
                </div>
            </div>

            <div class="model-card">
                <div style="width:60%">
                    <strong><?php echo htmlspecialchars($product["name"]); ?></strong>
                    <p>6.9-inch display</p>
                </div>
                <div style="width:40%">
                    <p>From $1199 or $49.95/mo for 24 mo.*</p>
                </div>
            </div>




            <div class="help-box">
                <strong>Need help choosing a model?</strong>
                <p>Explore the differences in screen size and battery life.</p>
            </div>

            <br>
            <h2><strong>Finish.</strong> Pick your favorite.</h2>
            <br>
            <b>Color</b>
            <div class="color-options" style="padding:10px">
                <?php
                if (!empty($product["colors"])) {
                    $colors = explode(",", $product["colors"]);
                    foreach ($colors as $color) {
                        echo '<div class="color-circle" style="background-color:' . htmlspecialchars(trim($color)) . ';"></div>';
                    }
                } else {
                    echo "<p>Không có tùy chọn màu.</p>";
                }
                ?>
            </div>

            <br>
            <br>
            <h2><strong>Storage.</strong> How much space do you need?</h2>

            <div class="storage-card">
                <div style="padding-left: 10px;">
                    <strong>128GB²</strong>
                </div>
                <div>
                    <p>From $999 or $41.62/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div style="padding-left: 10px;">
                    <strong>256GB²</strong>
                </div>
                <div>
                    <p>From $1099 or $45.79/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div style="padding-left: 10px;">
                    <strong>512GB²</strong>
                </div>
                <div>
                    <p>From $1299 or $54.12/mo. for 24 mo.*</p>
                </div>
            </div>

            <div class="storage-card">
                <div style="padding-left: 10px;">
                    <strong>1TB²</strong>
                </div>
                <div>
                    <p>From $1499 or $62.45/mo. for 24 mo.*</p>
                </div>
            </div>
            <button class="buy-button" style="">Mua</button>
        </div>
    </div>

<?php
require_once '../app/views/layouts/footer.php';
?>
