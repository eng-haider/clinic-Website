# Tooth Diagram Integration Guide

## Overview

The tooth diagram feature has been integrated into the patient lookup page to display colored tooth visualizations based on patient data.

## API Response Format

The system expects a `colored_parts` array in the API response with the following structure:

```json
{
    "success": true,
    "patient": { ... },
    "colored_parts": [
        {
            "tooth_number": 36,
            "tooth_id": "tooth-163",
            "part_id": 1,
            "color": "#2196F3"
        }
    ],
    "cases": [ ... ],
    "bills": [ ... ],
    "images": [ ... ]
}
```

## Data Structure

### colored_parts Array

Each object in the array represents a colored tooth part:

-   **tooth_number** (integer): The tooth number (e.g., 36, 11, 48)
    -   Valid range: 11-18, 21-28, 31-38, 41-48 (FDI notation)
-   **tooth_id** (string): Unique identifier for the tooth (optional, for internal tracking)
-   **part_id** (integer): The part of the tooth to color
    -   1 = Top/Occlusal
    -   2 = Right/Mesial
    -   3 = Center/Pulp
    -   4 = Left/Distal
    -   5 = Bottom/Cervical
-   **color** (string): Hex color code (e.g., "#2196F3", "#FF5252")

## Supported Colors

Common colors used in dental charting:

-   **Blue (#2196F3)**: Existing work/restoration
-   **Red (#FF5252)**: Treatment needed/active caries
-   **Green (#4CAF50)**: Completed treatment
-   **Yellow (#FFEB3B)**: Watch/monitor area
-   **Purple (#9C27B0)**: Endodontic treatment

## Features

### Visual Display

1. **Top Teeth Numbers**: Displays teeth 18-11 with active indicators
2. **Bottom Teeth Numbers**: Displays teeth 48-31 with active indicators
3. **SVG Tooth Diagram**: Interactive visual representation of all teeth
4. **Colored Parts**: Parts are filled with specified colors
5. **Active Tooth Highlighting**: Tooth numbers with colored parts are highlighted

### Responsive Design

-   Desktop: Full-width display with all teeth visible
-   Tablet: Compact spacing with scrollable container
-   Mobile: Responsive grid with touch-friendly interface

## Implementation Details

### Backend (Laravel Controller)

Add the `colored_parts` data to your API response:

```php
public function lookup(Request $request)
{
    $patient = Patient::where('code', $request->code)->first();

    if (!$patient) {
        return response()->json(['success' => false]);
    }

    // Get colored parts from patient's tooth data
    $coloredParts = $patient->toothColors()->get()->map(function($item) {
        return [
            'tooth_number' => $item->tooth_number,
            'tooth_id' => $item->tooth_id,
            'part_id' => $item->part_id,
            'color' => $item->color
        ];
    });

    return response()->json([
        'success' => true,
        'patient' => $patient,
        'colored_parts' => $coloredParts,
        // ... other data
    ]);
}
```

### Database Schema

Create a table to store tooth color data:

```sql
CREATE TABLE tooth_colors (
    id INT PRIMARY KEY AUTO_INCREMENT,
    patient_id INT NOT NULL,
    tooth_number INT NOT NULL,
    tooth_id VARCHAR(50),
    part_id INT NOT NULL,
    color VARCHAR(7) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    INDEX idx_patient_tooth (patient_id, tooth_number)
);
```

## Example Usage

### Test Data

```json
{
    "success": true,
    "patient": {
        "id": 5333,
        "name": "عبدالله هادي عبد",
        "age": 76
    },
    "colored_parts": [
        {
            "tooth_number": 36,
            "tooth_id": "tooth-163",
            "part_id": 1,
            "color": "#2196F3"
        },
        {
            "tooth_number": 11,
            "tooth_id": "tooth-11",
            "part_id": 3,
            "color": "#FF5252"
        },
        {
            "tooth_number": 48,
            "tooth_id": "tooth-48",
            "part_id": 5,
            "color": "#4CAF50"
        }
    ]
}
```

This will:

-   Color part 1 (top) of tooth 36 in blue
-   Color part 3 (center) of tooth 11 in red
-   Color part 5 (bottom) of tooth 48 in green
-   Highlight tooth numbers 36, 11, and 48 as active

## CSS Classes

-   `.tooth-diagram-section`: Main container
-   `.teeth-numbers-grid`: Grid for tooth numbers
-   `.tooth-number`: Individual tooth number badge
-   `.tooth-number.active`: Highlighted active tooth
-   `.tooth-part`: SVG path element for tooth parts

## JavaScript Functions

-   `displayToothDiagram(coloredParts)`: Main rendering function
-   `getTeethData()`: Returns tooth SVG path data
-   Automatically called when `colored_parts` exists in API response

## Troubleshooting

### Diagram Not Showing

-   Ensure `colored_parts` array exists in API response
-   Check that array is not empty
-   Verify tooth_number values are valid (11-18, 21-28, 31-38, 41-48)

### Colors Not Displaying

-   Verify color values are valid hex codes (e.g., "#2196F3")
-   Check part_id values are between 1-5
-   Ensure tooth_number matches existing tooth in diagram

### Active Indicators Not Showing

-   Confirm tooth numbers in `colored_parts` match FDI notation
-   Check that tooth numbers are integers, not strings

## Future Enhancements

-   Clickable teeth for detailed information
-   Legend showing color meanings
-   Export diagram as image
-   Print-friendly version
-   Touch gestures for mobile (zoom, pan)
