<?php

$GLOBALS['TCA']['pages']['columns']['tx_shortcutparams_parameters'] = [
    'label' => 'LLL:EXT:shortcut_params/Resources/Private/Language/locallang_db.xlf:pages.tx_shortcutparams_parameters',
    'config' => [
        'type' => 'input',
    ],
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette('pages', 'shortcutpage', '--linebreak--,tx_shortcutparams_parameters');
