<?php
/**
 * 公共函数库
 */

/**
 * 打印变量方法
 */
if ( ! function_exists('p'))
{
    function p($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

/**
 * 组装无限极分类树 递归方式
 */
if ( ! function_exists('recursiveTree'))
{
    function recursiveTree(&$categorys, $pid = 0) {
        $tree = [];
        foreach ($categorys as $key => $val) {
            if ($val['parent_id'] == $pid) {
                unset($categorys[$key]);
                $val['child'] = recursiveTree($categorys, $val['id']);
                $tree[$val['id']] = $val;
            }
        }
        return $tree;
    }
}

/**
 * 组装无限极分类树 引用传递
 */
if ( ! function_exists('referencesTree'))
{
    function referencesTree($categorys) {
        foreach ($categorys as $val) {
            $middle[$val['id']] = $val;
        }
        $tree = [];
        foreach ($middle as $val) {
            if (isset($middle[$val['parent_id']])) {
                $middle[$val['parent_id']]['child'][] = &$middle[$val['id']];
            } else {
                $tree[] = &$middle[$val['id']];
            }
        }
        return $tree;
    }
}

/**
 * 组装无限极分类树 层级倒序
 */
if ( ! function_exists('gradeTree'))
{
    function gradeTree($categorys) {
        foreach ($categorys as $val) {
            if (isset($tree[$val['id']])) {
                $val['child'] = $tree[$val['id']];
                unset($tree[$val['id']]);
            }
            $tree[$val['parent_id']][] = $val;
        }
        return $tree[0];
    }
}
