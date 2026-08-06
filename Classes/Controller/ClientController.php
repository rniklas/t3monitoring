<?php

declare(strict_types=1);

namespace T3Monitor\T3monitoring\Controller;

/*
 * This file is part of the t3monitoring extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use Psr\Http\Message\ResponseInterface;
use T3Monitor\T3monitoring\Domain\Model\Client;
use T3Monitor\T3monitoring\Service\Import\ClientImport;
use TYPO3\CMS\Backend\Attribute\AsController;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;

#[AsController]
class ClientController extends BaseController
{
    #[IgnoreValidation(['argumentName' => 'client'])]
    public function showAction(?Client $client = null): ResponseInterface
    {
        if ($client === null) {
            // @todo flash message
            return $this->redirect('index', 'Statistic');
        }

        $this->moduleTemplate->assignMultiple([
            'client' => $client,
        ]);

        return $this->htmlResponse();
    }

    #[IgnoreValidation(['argumentName' => 'client'])]
    public function fetchAction(?Client $client = null): ResponseInterface
    {
        if ($client === null) {
            // @todo flash message
            return $this->redirect('index', 'Statistic');
        }

        /** @var ClientImport $import */
        $import = GeneralUtility::makeInstance(ClientImport::class);
        $import->run($client->getUid());
        $this->addFlashMessage($this->getLabel('fetchClient.success'));
        return $this->redirect('show', null, null, ['client' => $client]);
    }
}
