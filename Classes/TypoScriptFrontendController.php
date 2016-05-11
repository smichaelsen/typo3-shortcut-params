<?php
namespace Smichaelsen\ShortcutParams;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\HttpUtility;
use TYPO3\CMS\Core\Utility\MathUtility;
use TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer;

class TypoScriptFrontendController extends \TYPO3\CMS\Frontend\Controller\TypoScriptFrontendController
{

    /**
     * Builds a typolink to the current page, appends the type parameter if required
     * and redirects the user to the generated URL using a Location header.
     *
     * @return void
     */
    protected function redirectToCurrentPage()
    {
        $this->calculateLinkVars();
        // Instantiate \TYPO3\CMS\Frontend\ContentObject to generate the correct target URL
        /** @var $cObj ContentObjectRenderer */
        $cObj = GeneralUtility::makeInstance(ContentObjectRenderer::class);
        $parameter = $this->page['uid'];
        $type = GeneralUtility::_GET('type');
        if ($type && MathUtility::canBeInterpretedAsInteger($type)) {
            $parameter .= ',' . $type;
        }
        $typolinkParameters = array('parameter' => $parameter);
        $redirectUrl = $cObj->typoLink_URL(
            $this->addAdditionalParamsToShortcutTypolink($typolinkParameters)
        );

        // Prevent redirection loop
        if (!empty($redirectUrl)) {
            // redirect and exit
            HttpUtility::redirect($redirectUrl, HttpUtility::HTTP_STATUS_307);
        }
    }

    /**
     * @param array $typolinkParameters
     * @return array
     */
    protected function addAdditionalParamsToShortcutTypolink($typolinkParameters)
    {
        if (isset($this->originalShortcutPage['tx_shortcutparams_parameters']) && !empty($this->originalShortcutPage['tx_shortcutparams_parameters'])) {
            list($additionalParams, $section) = explode('#', $this->originalShortcutPage['tx_shortcutparams_parameters'], 2);
            if (!empty($additionalParams)) {
                if ($additionalParams[0] !== '&') {
                    $additionalParams = '&' . $additionalParams;
                }
                $typolinkParameters['additionalParameters'] = $additionalParams;
            }
            if (!empty($section)) {
                $typolinkParameters['parameter'] .= '#' . $section;
            }
        }
        return $typolinkParameters;
    }

}
