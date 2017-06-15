<?php
/**
 * Created by PhpStorm.
 * User: favor1t
 * Date: 12.06.2017
 * Time: 14:25
 */

namespace app\modules\tree\common;


use app\modules\tree\common\Tree;

class TreeList extends Tree
{
    static function getTreeList()
    {
        $res = parent::find()
            ->indexBy['id']
            ->orderBy(['pid' => SORT_ASC])
            ->asArray()
            ->all();

        return self::_createTreeList($res, 'pid');
    }

    private static function _createTreeList($res, $key)
    {
        if (is_array($res)) {
            foreach ($res as $id => $node) {
                if (isset($res[$node[$key]]))
                    $res[$node[$key]]['sub'][$id] = &$res[$id];
            }
            return self::_prepareTreeList($res, $key, 0);
        }

        return false;
    }

    private static function _prepareTreeList($res, $key, $val)
    {
        foreach ($res as $id => $node) {
            if ($node[$key] != $val)
                unset($res[$id]);
        }

        return $res;
    }

}