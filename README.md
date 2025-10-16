# Alesis D4 Note Editor

A comprehensive web-based interface for editing MIDI note names in Alesis D4.midnam files with real-time MIDI testing capabilities.

## Features

### **Core Editing**
- **Drumset Management**: Switch between all 21 Alesis D4 drumsets
- **Note Editor**: Edit note names with intelligent autocomplete
- **Add/Delete Notes**: Manage notes with automatic renumbering
- **Insert Notes**: Insert notes at specific positions with smart placement
- **XML Validation**: Validate against DTD with visual feedback
- **Auto-backup**: Creates timestamped backups before saving changes

### **MIDI Integration**
- **WebMIDI Support**: Real-time MIDI output for testing sounds
- **Automatic Program Changes**: Switches MIDI device to correct drumset
- **Piano Key Styling**: Visual representation of black/white keys
- **Interactive Testing**: Click note numbers to play sounds
- **Device Management**: Connect to any MIDI output device

### **User Experience**
- **Keyboard Navigation**: Full keyboard workflow with arrow keys and Enter
- **Visual Feedback**: Button states show save/validation status
- **Musical Context**: Note names and piano key styling
- **Responsive Design**: Works on different screen sizes
- **Auto-scroll**: Page follows your work when adding notes

## Setup

### **Quick Start (Python Server)**
```bash
cd /path/to/midnams
python3 simple_server.py
```
Then open: http://localhost:8000/d4_editor.html

### **Alternative: PHP Server**
If you have PHP and a web server:
1. Place files in your web server directory
2. Open: http://your-server/d4_editor.html

## Usage

### **MIDI Setup**
1. **Enable MIDI**: Click "Enable MIDI" button (grants browser permission)
2. **Select Device**: Choose your MIDI output device from dropdown
3. **Verify Connection**: Status shows "Connected to: [Device Name]"

### **Drumset Editing**
1. **Select Drumset**: Choose from dropdown (automatically sends program change)
2. **Edit Notes**: Click note name fields to edit with autocomplete
3. **Test Sounds**: Click note numbers (piano keys) to play sounds
4. **Add Notes**: Click "+" button to add new notes
5. **Delete Notes**: Click "×" button to remove notes
6. **Insert Notes**: Click "+" to insert notes at specific positions

### **Keyboard Shortcuts**
- **↓/↑ Arrow Keys**: Navigate autocomplete dropdown
- **Enter**: Select from dropdown or commit custom text
- **Escape**: Close dropdown
- **Enter on "+"**: Add new note
- **Space on "+"**: Add new note (alternative)

### **Save & Validate**
- **Save Changes**: Button turns green "Saved ✓" when complete
- **Validate XML**: Button shows green "Valid ✓" or red "Invalid ✗"
- **Auto-reset**: Buttons revert to blue when changes are made

## DAW Compatibility

**Note names will only appear in specific DAWs that support MIDINameDocument:**

### **Supported DAWs:**
- **Avid Pro Tools** - Full support for note names
- **Steinberg Cubase** - Limited support
- **PreSonus Studio One** - Basic support

### **Not Supported:**
- **Apple Logic Pro** - Does not use .midnam files
- **Ableton Live** - Uses different naming system
- **FL Studio** - No .midnam support
- **Reason** - No .midnam support

## File Structure

- `d4_editor.html` - Main web interface
- `simple_server.py` - Python HTTP server with MIDI functionality
- `Alesis/D4.midnam` - The XML file being edited
- `midnam.dtd` - DTD for validation
- `assets/kbd.svg` - MIDI keyboard icon for tooltips

## Technical Details

### **MIDI Implementation**
- **WebMIDI API**: Uses browser's native MIDI support
- **Program Changes**: Automatically sends MIDI program change messages
- **Note Messages**: Sends MIDI note on/off with 200ms duration
- **Channel 1**: All MIDI messages sent on channel 1

### **XML Structure**
- **MIDINameDocument**: Standard XML format for MIDI device names
- **Patch Elements**: Each drumset is a `<Patch>` with program change
- **NoteNameList**: Contains `<Note>` elements with number and name
- **DTD Validation**: Ensures XML structure is correct

### **Browser Requirements**
- **Chrome/Edge**: Full WebMIDI support
- **Firefox**: Limited WebMIDI support
- **Safari**: No WebMIDI support (graceful degradation)

## Notes

- The editor automatically creates backups before saving
- Note numbers are kept consecutive and unique
- Special characters are handled as HTML entities
- All changes are validated against the DTD before saving
- MIDI program changes are sent automatically when switching drumsets
- Piano key styling helps identify black/white keys visually