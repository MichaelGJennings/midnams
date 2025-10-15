# Alesis D4 Note Editor

A web-based interface for editing note names in the Alesis D4.midnam file.

## Features

- **Drumset Selector**: Switch between all 21 drumsets
- **Note Editor**: Edit note names with autocomplete from existing names
- **Add/Delete Notes**: Manage notes with automatic renumbering
- **Insert Notes**: Insert notes at specific positions
- **XML Validation**: Validate against DTD before saving
- **Auto-backup**: Creates backups before saving changes
- **Special Characters**: Handles HTML entities automatically

## Setup

### Option 1: Python Server (Recommended)

1. Make sure you have Python 3 installed
2. Run the server:
   ```bash
   python3 simple_server.py
   ```
3. Open your browser to: http://localhost:8000/d4_editor.html

### Option 2: PHP Server

If you have PHP and a web server:

1. Place files in your web server directory
2. Open: http://your-server/d4_editor.html

## Usage

1. **Select Drumset**: Choose from the dropdown at the top
2. **Edit Notes**: Click on note name fields to edit
3. **Autocomplete**: Type to see filtered suggestions from all existing note names
4. **Add Notes**: Use the "Add Note" section at the bottom
5. **Delete Notes**: Click "Delete" button next to any note
6. **Insert Notes**: Click "Insert" to add a note at a specific position
7. **Validate**: Click "Validate XML" to check against DTD
8. **Save**: Click "Save Changes" to update the file

## File Structure

- `d4_editor.html` - Main web interface
- `server.py` - Python HTTP server with PHP-like functionality
- `load_d4.php` - PHP endpoint to serve XML (if using PHP server)
- `save_d4.php` - PHP endpoint to save changes (if using PHP server)
- `validate_d4.php` - PHP endpoint to validate XML (if using PHP server)
- `Alesis/D4.midnam` - The XML file being edited
- `midnam.dtd` - DTD for validation

## Notes

- The editor automatically creates backups before saving
- Note numbers are kept consecutive and unique
- Special characters are handled as HTML entities
- All changes are validated before saving
