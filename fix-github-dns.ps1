# Run this script as Administrator
# Right-click PowerShell > Run as Administrator, then execute this script

param()

$hostsPath = "$env:SystemRoot\System32\drivers\etc\hosts"
$backupPath = "$env:SystemRoot\System32\drivers\etc\hosts.backup.$(Get-Date -Format 'yyyyMMdd_HHmmss')"

Write-Host "=== Fix GitHub DNS Resolution ===" -ForegroundColor Cyan
Write-Host ""

# Check admin
$isAdmin = ([Security.Principal.WindowsPrincipal] [Security.Principal.WindowsIdentity]::GetCurrent()).IsInRole([Security.Principal.WindowsBuiltInRole]::Administrator)
if (-not $isAdmin) {
    Write-Host "ERROR: Please run this script as Administrator!" -ForegroundColor Red
    Write-Host "Right-click PowerShell > Run as Administrator" -ForegroundColor Yellow
    pause
    exit 1
}

# Backup
Copy-Item $hostsPath $backupPath -Force
Write-Host "Backup created: $backupPath" -ForegroundColor Green

# Read current hosts
$hostsContent = Get-Content $hostsPath -Raw

# Entries to add
$entries = @(
    "20.205.243.166 github.com",
    "20.205.243.165 codeload.github.com",
    "185.199.110.133 objects.githubusercontent.com",
    "20.205.243.168 api.github.com"
)

# Check which entries are missing
$missing = $entries | Where-Object { $_ -notmatch [regex]::Escape(($_.Split(' ')[1])) }

if ($missing.Count -eq 0) {
    Write-Host "All GitHub entries already exist in hosts file." -ForegroundColor Yellow
} else {
    Write-Host "Adding missing entries:" -ForegroundColor Green
    $missing | ForEach-Object { Write-Host "  + $_" -ForegroundColor Gray }
    
    # Add entries
    Add-Content -Path $hostsPath -Value ""
    Add-Content -Path $hostsPath -Value "# GitHub entries for deployment - $(Get-Date -Format 'yyyy-MM-dd HH:mm:ss')"
    $missing | ForEach-Object { Add-Content -Path $hostsPath -Value $_ }
}

Write-Host ""
Write-Host "=== Verifying DNS resolution ===" -ForegroundColor Cyan
nslookup github.com 127.0.0.1
Write-Host ""
Write-Host "Done! Try: git push origin main" -ForegroundColor Green
pause
