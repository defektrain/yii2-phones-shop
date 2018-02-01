<?php

namespace common\helpers;

/**
 * Class TreeHelper
 * @package common\helpers
 */
class TreeHelper
{
    /**
     * @param $models
     * @param int $parentId
     * @param int $level
     * @return array
     */
    public static function makeTree($models, $parentId = 0, $level = 0)
    {
        if (!$parentId) {
            $parentId = self::getParentId($models);
        }

        $newModels = [];
        foreach ($models as $key => $item) {
            if (!$item->parent_id && !$parentId) {
                $newModels[] = $item;

                $childs = self::makeTree($models, $item->id);
                $newModels = array_merge($newModels, $childs);
            } elseif ($item->parent_id == $parentId) {
                $item->name = self::formatName($item->name, $level);
                $newModels[] = $item;

                $childs = self::makeTree($models, $item->id, ++$level);
                $newModels = array_merge($newModels, $childs);
                $level--;
            }
        }

        return $newModels;
    }

    /**
     * @param $name
     * @param int $level
     * @return string
     */
    protected static function formatName($name, $level = 0)
    {
        $prefix = '';
        for ($i = 0; $i <= $level; $i++) {
            $prefix .= " → ";
        }

        $name = $prefix . $name;

        return $name;
    }

    /**
     * @param $models
     * @return int
     */
    protected static function getParentId($models)
    {
        $firstItem = reset($models);
        if ($firstItem) {
            $parentId = $firstItem->parent_id;
        }

        foreach ($models as $item) {
            if (!$item->parent_id) {
                $parentId = 0;
                break;
            }
        }

        return $parentId;
    }
}