<?php

namespace Niiph\SyliusProductLabelPlugin\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\ClassMetadataInfo;

#[AsDoctrineListener(Events::loadClassMetadata)]
class TablePrefixEventListener
{
    private ?string $currentVendor = null;

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs): void
    {
        if (!$this->currentVendor) {
            $this->currentVendor = strtolower(explode('\\', __CLASS__)[0]);
        }

        $classMetadata = $eventArgs->getClassMetadata();

        if (!$classMetadata->isInheritanceTypeSingleTable() || $classMetadata->getName() === $classMetadata->rootEntityName) {
            $classMetadata->setPrimaryTable([
                'name' => $this->getPrefix($classMetadata->getName(), $classMetadata->getTableName()) . $classMetadata->getTableName()
            ]);
        }

        foreach ($classMetadata->getAssociationMappings() as $fieldName => $mapping) {
            if ($mapping['type'] == ClassMetadataInfo::MANY_TO_MANY && $mapping['isOwningSide']) {
                $mappedTableName = $mapping['joinTable']['name'];
                $classMetadata->associationMappings[$fieldName]['joinTable']['name'] = $this->getPrefix($mapping['targetEntity'], $mappedTableName) . $mappedTableName;
            }
        }
    }

    protected function getPrefix(string $className, string $tableName): string
    {
        // get the namespaces from the class name
        // $className might be "App\Calendar\Entity\CalendarEntity"
        $nameSpaces = explode('\\', $className);
        $vendor = isset($nameSpaces[0]) ? strtolower($nameSpaces[0]) : null;

        if ($this->currentVendor !== $vendor) {
            return '';
        }

        $prefix = sprintf('%s_', $vendor);
        // table is already prefixed with bundle name
        if (str_starts_with($tableName, $prefix)) {
            return '';
        }

        return $prefix;
    }
}
