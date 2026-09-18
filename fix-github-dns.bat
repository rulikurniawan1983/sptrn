@echo off
echo === Fixing GitHub DNS Resolution ===
echo.

set HOSTS=%SystemRoot%\System32\drivers\etc\hosts

echo Adding GitHub IP entries to hosts file...
echo.

echo 20.205.243.166 github.com >> %HOSTS%
echo 20.205.243.165 codeload.github.com >> %HOSTS%
echo 185.199.110.133 objects.githubusercontent.com >> %HOSTS%
echo 20.205.243.168 api.github.com >> %HOSTS%

echo.
echo === Verifying entries ===
nslookup github.com 127.0.0.1
echo.
echo Done! Now try: git push origin main
