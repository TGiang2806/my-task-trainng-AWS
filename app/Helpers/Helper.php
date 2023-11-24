<?php

namespace App\Helpers;

class Helper
{
    /**
     * @param $menus
     * @param $parent_id
     * @param $char
     * @return string
     */
//    public static function menu($menus, $parent_id = 0, $char = '')
//    {
//        $html = '';
//        foreach ($menus as $key => $menu) {
//            if ($menu->parent_id == $parent_id) {
//                $html .= '
//                        <tr>
//                            <td>' . $menu->id . '</td>
//                           <td>' . $char . $menu->name . '</td>
//                           <td>' . self::active($menu->active) . '</td>
//                           <td>' . $menu->updated_at . '</td>
//                            <td>
//                            <a  class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id . '">
//                          <i class="fa fa-edit" aria-hidden="true"></i>
//                            </a>
//
//                            <a  class="btn btn-danger btn-sm" href="#"
//                            onclick="removeRow(' . $menu->id . ',\'/admin/menus/destroy\')">
//                            <i class="fa fa-trash" aria-hidden="true"></i>
//                            </a>
//
//                            </td>
//                        </tr>
//
//
//               ';
//
//                unset($menu[$key]);
//                //
//                $html .= self::menu($menus, $menu->id, $char . '--');
//            }
//        }
//        return $html;
//    }

    /**
     * @param $active
     * @return string|void
     */
    public static function active($active = 0)
    {
        if ($active == 0) {
            return '<span class="btn btn-danger btn-xs">Inactive</span>';
        } elseif ($active == 1 ) {
            return '<span class="btn btn-success btn-xs">Active</span>';
        } elseif ($active == 2 ) {
            return '<span class="btn btn-warning btn-xs">Deplaying</span>';
        }
    }

    /**
     * @param $type
     * @return string|void
     */
    public static function type($type = 0)
    {
        if ($type == 0) {
            return '<span class="btn btn-danger btn-xs">New</span>';
        } elseif ($type == 1 ) {
            return '<span class="btn btn-success btn-xs">Regular</span>';
        } elseif ($type == 2) {
            return '<span class="btn btn-warning btn-xs">Vip</span>';
        }
    }

    /**
     * @param $group
     * @return string|void
     */
    public static function group($group = 0)
    {
        if ($group == 0) {
            return '<span class="btn btn-danger btn-xs">Admin</span>';
        } elseif ($group == 1 ) {
            return '<span class="btn btn-success btn-xs">Editor</span>';
        } elseif ($group == 2) {
            return '<span class="btn btn-warning btn-xs">Reviewer</span>';
        }
    }

    /**
     * @param $gender
     * @return string|void
     */
    public static function gender($gender = 0)
    {
        if ($gender == 0) {
            return 'Male';
        } else  {
            return 'Female';

        }
    }

    /**
     * @param $delete
     * @return string|void
     */
    public static function delete($delete = 0)
    {
        if ($delete == 0) {
            return 'Delete';
        } elseif ($delete == 1 ) {
            return 'No Delete';

        }
    }
//    public static function statususer($statususer = 0)
//    {
//        if ($statususer == 0) {
//            return 'Delete';
//        } elseif ($statususer == 1 ) {
//            return 'No Delete';
//
//        }
//    }
}
