<?php
declare(strict_types=1);

/*
 * This file is part of the package bk2k/bootstrap-package.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace BK2K\BootstrapPackage\ViewHelpers\TypoScript;

use BK2K\BootstrapPackage\Utility\TypoScriptUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContext;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractViewHelper;

/**
 * ConstantViewHelper
 *
 * {bk2k:typoScript.constant(constant: 'identifier')}
 */
class ConstantViewHelper extends AbstractViewHelper
{
    /**
     * @var bool
     */
    protected $escapeOutput = false;

    public function initializeArguments(): void
    {
        parent::initializeArguments();
        $this->registerArgument('constant', 'string', 'TypoScript constant');
    }

    public function render(): string
    {
        $renderingContext = $this->renderingContext;
        if ($renderingContext instanceof RenderingContext && $renderingContext->getRequest() !== null) {
            $constant = $this->arguments['constant'] ?? '';
            return TypoScriptUtility::getConstants($renderingContext->getRequest())[$constant] ?? '';
        }

        throw new \RuntimeException(
            'ViewHelper bk2k:typoScript.constant needs a request implementing ServerRequestInterface.',
            1639819269
        );
    }
}
