@echo off
REM Camera Feature Migration Script for Windows
REM This script applies the database changes needed for the camera capture feature

echo ===================================
echo Camera Feature Database Migration
echo ===================================
echo.

REM Check if we're in the right directory
if not exist "database_schema\upgrades\4.1\schema.sql" (
    echo ERROR: Please run this script from the LibreBooking app root directory
    pause
    exit /b 1
)

REM Prompt for database credentials
set /p DB_USER="Enter MySQL username: "
set /p DB_PASS="Enter MySQL password: "
set /p DB_NAME="Enter database name: "
set /p DB_HOST="Enter MySQL host [localhost]: "
if "%DB_HOST%"=="" set DB_HOST=localhost

echo.
echo Connecting to database...

REM Run the migration
mysql -h %DB_HOST% -u %DB_USER% -p%DB_PASS% %DB_NAME% < database_schema\upgrades\4.1\schema.sql

if %ERRORLEVEL% EQU 0 (
    echo.
    echo [SUCCESS] Migration completed successfully!
    echo.
    echo The 'note' column has been added to the reservation_files table.
    echo.
    echo Next steps:
    echo 1. Clear template cache: Remove-Item -Path tpl_c\* -Recurse -Force
    echo 2. Test the camera feature in Edit Reservation page
    echo.
) else (
    echo.
    echo [ERROR] Migration failed!
    echo Please check your database credentials and try again.
    pause
    exit /b 1
)

pause
