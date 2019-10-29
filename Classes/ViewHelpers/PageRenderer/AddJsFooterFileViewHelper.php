<?php

namespace FelixNagel\Beautyofcode\ViewHelpers\PageRenderer;

/**
 * This file is part of the "beautyofcode" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Frontend\Resource\FilePathSanitizer;

/**
 * Adds javascript libraries to the page footer.
 *
 * @author Thomas Juhnke <typo3@van-tomas.de>
 * @author (c) 2014 Felix Nagel <info@felixnagel.com>
 */
class AddJsFooterFileViewHelper extends \FelixNagel\Beautyofcode\Core\ViewHelper\AbstractPageRendererViewHelper
{
    /**
     * Initialize arguments.
     */
    public function initializeArguments()
    {
        $this->registerArgument('file', 'string', 'File name');
        $this->registerArgument('type', 'string', 'Content Type', false, 'text/javascript');
        $this->registerArgument('compress', 'bool', 'TYPO3 compress flag', false, true);
        $this->registerArgument('forceOnTop', 'bool', 'TYPO3 force-on-top flag', false, false);
        $this->registerArgument('allWrap', 'string', 'TYPO3 allWrap configuration', false, '');
        $this->registerArgument('excludeFromConcatenation', 'bool', 'TYPO3 excl. from concat. flag', false, false);
        $this->registerArgument('splitChar', 'string', 'The char used to split the allWrap value', false, '|');
    }

    /**
     * Adds JS file to footer.
     */
    public function render()
    {
        if (file_exists($this->arguments['file'])) {
            /** @var FilePathSanitizer $filePathSanitizer */
            $filePathSanitizer = GeneralUtility::makeInstance(FilePathSanitizer::class);

            $this->pageRenderer->addJsFooterFile(
                $filePathSanitizer->sanitize($this->arguments['file']),
                $this->arguments['type'],
                $this->arguments['compress'],
                $this->arguments['forceOnTop'],
                $this->arguments['allWrap'],
                $this->arguments['excludeFromConcatenation'],
                $this->arguments['splitChar']
            );
        }
    }
}
