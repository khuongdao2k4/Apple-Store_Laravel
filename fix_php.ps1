$path = "d:\xampp\htdocs\Apple_store-Laravel\resources\views\pages\*.blade.php"
$files = Get-ChildItem -Path $path
foreach ($file in $files) {
    if ($file.Length -eq 0) { continue }
    $content = Get-Content $file.FullName -Raw

    $content = [System.Text.RegularExpressions.Regex]::Replace($content, "(?s)<\?php\s*\\`$pageTitle\s*=.*?\?>", "")
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, "(?s)<\?php\s*require_once.*?\?>", "")
    $content = [System.Text.RegularExpressions.Regex]::Replace($content, "(?s)<\?php\s*\?>", "")
    
    Set-Content -Path $file.FullName -Value $content -Encoding UTF8
    Write-Host "Fixed $($file.Name)"
}
