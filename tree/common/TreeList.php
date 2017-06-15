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
            ->orderBy(['sid' => SORT_ASC])
            ->asArray()
            ->all();

        return self::_prepareTreeList($res);

    }

    private static function _prepareTreeList($res)
    {
        if (is_array($res)) {
            foreach ($res as $id => $node) {
                if (isset($res[$node['pid']])) {
                    $res[$node['pid']]['sub'][$id] = &$res[$id];
                }
            }
            return $res;
        }

        return false;
    }

}