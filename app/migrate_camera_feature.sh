#!/bin/bash

# Camera Feature Migration Script
# This script applies the database changes needed for the camera capture feature

echo "==================================="
echo "Camera Feature Database Migration"
echo "==================================="
echo ""

# Check if we're in the right directory
if [ ! -f "database_schema/upgrades/4.1/schema.sql" ]; then
    echo "ERROR: Please run this script from the LibreBooking app root directory"
    exit 1
fi

# Prompt for database credentials
read -p "Enter MySQL username: " DB_USER
read -sp "Enter MySQL password: " DB_PASS
echo ""
read -p "Enter database name: " DB_NAME
read -p "Enter MySQL host [localhost]: " DB_HOST
DB_HOST=${DB_HOST:-localhost}

echo ""
echo "Connecting to database..."

# Run the migration
mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < database_schema/upgrades/4.1/schema.sql

if [ $? -eq 0 ]; then
    echo ""
    echo "✓ Migration completed successfully!"
    echo ""
    echo "The 'note' column has been added to the reservation_files table."
    echo ""
    echo "Next steps:"
    echo "1. Clear template cache: rm -rf tpl_c/*"
    echo "2. Test the camera feature in Edit Reservation page"
    echo ""
else
    echo ""
    echo "✗ Migration failed!"
    echo "Please check your database credentials and try again."
    exit 1
fi
