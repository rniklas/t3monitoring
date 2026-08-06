<?php

declare(strict_types=1);

namespace T3Monitor\T3monitoring\Service\Import;

/*
 * This file is part of the t3monitoring extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */

use Psr\EventDispatcher\EventDispatcherInterface;
use T3Monitor\T3monitoring\Domain\Model\Dto\EmMonitoringConfiguration;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Database\ConnectionPool;
use TYPO3\CMS\Core\Registry;

class BaseImport
{
    public function __construct(
        protected readonly Context $context,
        protected readonly ConnectionPool $connectionPool,
        protected EmMonitoringConfiguration $emConfiguration,
        protected Registry $registry,
        protected EventDispatcherInterface $eventDispatcher,
    ) {}

    protected function setImportTime(string $action): void
    {
        $now = $this->context->getAspect('date')->get('timestamp');
        $this->registry->set('t3monitoring', 'import' . ucfirst($action), $now);
    }
}
