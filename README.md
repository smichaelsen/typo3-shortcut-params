# Shortcut Params
## TYPO3 Extension

`shortcut_params` allows you to add additional link parameters when using a TYPO3 shortcut page.
 
![Screenshot](Documentation/Images/Screenshot_Backend_Form.png?raw=true "Screenshot")

## Installation

Installation via composer is recommended:

`composer require smichaelsen/shortcut-params`

Install in the TYPO3 Extension Manager afterwards.

## Usage

The extension is usable right away without further configuration. When editing a shortcut page, you notice a new form
field for your additional attributes.

Please provide "raw" GET parameters - they will be parsed by typolink (and `realurl` if applicable) afterwards:
 
    ?tx_myext_plugin[foo]=bar
    
Also providing *sections* is supported:

    ?tx_myext_plugin[foo]=bar#content
