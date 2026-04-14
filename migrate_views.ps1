$sourcePath = "d:\xampp\htdocs\Apple_store-Laravel\app\views\pages"
$destPath = "d:\xampp\htdocs\Apple_store-Laravel\laravel_setup\resources\views\pages"

if (-not (Test-Path $destPath)) { New-Item -ItemType Directory -Force -Path $destPath | Out-Null }

foreach ($file in Get-ChildItem -Path $sourcePath -Filter *.php) {
    if ($file.Length -eq 0) { continue }
    $content = Get-Content $file.FullName -Raw

    # Extract pageTitle
    $pageTitle = $file.Name
    if ($content -match '\$pageTitle\s*=\s*"([^"]+)";') {
        $pageTitle = $matches[1]
    }

    # Remove all PHP blocks that do requires
    $content = $content -replace "(?s)<\?php\s*\\$pageTitle.*?layouts/navbar\.php';\s*\?>", ""
    $content = $content -replace "(?s)<\?php\s*require_once.*?layouts/navbar\.php';\s*\?>", ""
    $content = $content -replace "(?s)<\?php\s*require_once.*?layouts/footer\.php';\s*\?>", ""
    $content = $content -replace "(?s)<\?php\s*include_once.*?>\s*", ""

    # Replace BASE_URL
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, "<\?=\s*BASE_URL\s*\?>public/assets/([^`"'\s]+)", "{{ asset('assets/`$1') }}")

    $newContent = "@extends('layouts.app', ['pageTitle' => '$pageTitle'])`n`n@section('content')`n$content`n@endsection"
    
    $newName = $file.Name -replace '\.php$', '.blade.php'
    Set-Content -Path "$destPath\$newName" -Value $newContent -Encoding UTF8
    Write-Host "Migrated $newName"
}
