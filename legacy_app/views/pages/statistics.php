<?php


$month = isset($_GET['month']) ? $_GET['month'] : date('m');
$year = isset($_GET['year']) ? $_GET['year'] : date('Y');

// Truy vấn thống kê hóa đơn theo tháng và năm
$sql = "SELECT id_order, username, product, price, created_at FROM orders WHERE MONTH(created_at) = ? AND YEAR(created_at) = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $month, $year);
$stmt->execute();
$result = $stmt->get_result();

// Truy vấn tổng doanh thu
$sql_total = "SELECT price FROM orders WHERE MONTH(created_at) = ? AND YEAR(created_at) = ?";
$stmt_total = $conn->prepare($sql_total);
$stmt_total->bind_param("ii", $month, $year);
$stmt_total->execute();
$total_result = $stmt_total->get_result();

$total_revenue = 0;
while ($row = $total_result->fetch_assoc()) {
    $numeric_price = (float) preg_replace('/[^0-9]/', '', $row['price']); // Lọc số từ price
    $total_revenue += $numeric_price;
}
?>

<?php
$pageTitle = "statistics.php";
require_once '../app/views/layouts/header.php';
require_once '../app/views/layouts/navbar.php';
?>

<div class="container mt-4">
    <h2 class="text-center">Thống kê hóa đơn đã bán</h2>
    <br>
    <form method="GET" class="row g-3">
        <div class="col-md-4">
            <label for="month" class="form-label">Chọn tháng</label>
            <select name="month" id="month" class="form-select">
                <?php for ($m = 1; $m <= 12; $m++): ?>
                    <option value="<?php echo $m; ?>" <?php echo ($m == $month) ? 'selected' : ''; ?>><?php echo $m; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label for="year" class="form-label">Chọn năm</label>
            <select name="year" id="year" class="form-select">
                <?php for ($y = 2020; $y <= date('Y'); $y++): ?>
                    <option value="<?php echo $y; ?>" <?php echo ($y == $year) ? 'selected' : ''; ?>><?php echo $y; ?></option>
                <?php endfor; ?>
            </select>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary">Xem thống kê</button>
        </div>
    </form>
    
    <h4 class="mt-4">Tổng doanh thu: <?php echo number_format($total_revenue, 0, ',', '.'); ?> VNĐ</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID Hóa đơn</th>
                <th>Khách hàng</th>
                <th>Sản phẩm</th>
                <th>Tổng tiền</th>
                <th>Ngày mua</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <?php $numeric_price = (float) preg_replace('/[^0-9]/', '', $row['price']); ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id_order']); ?></td>
                    <td><?php echo htmlspecialchars($row['username']); ?></td>
                    <td><?php echo htmlspecialchars($row['product']); ?></td>
                    <td><?php echo number_format($numeric_price, 0, ',', '.'); ?> VNĐ</td>
                    <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <canvas id="revenueChart" class="mt-4"></canvas>
</div>

<?php
require_once '../app/views/layouts/footer.php';
?>
