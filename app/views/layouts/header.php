
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng Nhập Tài Khoản Apple</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"

        integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?= BASE_URL ?>public/assets/css/navbar-shared.css?v=<?= time() ?>">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    <?php
    if (isset($pageTitle)) {
        $baseName = str_replace('.php', '', $pageTitle);
        $potentialCss = "apple_{$baseName}-styles.css";
        $projectRoot = dirname(__DIR__, 3);
        $checkPath = $projectRoot . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . $potentialCss;
        
        // Nạp CSS theo tên trang
        if (file_exists($checkPath)) {
            echo '<link rel="stylesheet" href="' . BASE_URL . 'public/assets/css/' . $potentialCss . '?v=' . time() . '">';
        }
    }
    ?>
    <link rel="icon" type="image/x-icon" href="<?= BASE_URL ?>public/assets/img/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Slick Carousel JS -->
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <?php
    if (isset($pageTitle)) {
        $potentialJs = "js-apple_{$baseName}.js";
        $checkJsPath = $projectRoot . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . $potentialJs;
        if (file_exists($checkJsPath)) {
            echo '<script src="' . BASE_URL . 'public/assets/js/' . $potentialJs . '?v=' . time() . '"></script>';
        }
    }
    ?>


</head>

