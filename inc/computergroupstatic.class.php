<?php
use Glpi\Application\View\TemplateRenderer;

/**
 * -------------------------------------------------------------------------
 * DatabaseInventory plugin for GLPI
 * -------------------------------------------------------------------------
 *
 * LICENSE
 *
 * This file is part of DatabaseInventory.
 *
 * DatabaseInventory is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * DatabaseInventory is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with DatabaseInventory. If not, see <http://www.gnu.org/licenses/>.
 * -------------------------------------------------------------------------
 * @copyright Copyright (C) 2021-2023 by Teclib'.
 * @license   GPLv3 https://www.gnu.org/licenses/gpl-3.0.html
 * @link      https://services.glpi-network.com
 * -------------------------------------------------------------------------
 */

class PluginDatabaseinventoryComputerGroupStatic extends CommonDBRelation
{
    // From CommonDBRelation
    public static $itemtype_1 = 'PluginDatabaseinventoryComputerGroup';
    public static $items_id_1 = 'plugin_databaseinventory_computergroups_id';
    public static $itemtype_2 = 'Computer';
    public static $items_id_2 = 'computers_id';

    public static $checkItem_2_Rights  = self::DONT_CHECK_ITEM_RIGHTS;
    public static $logs_for_item_2     = false;
    public $auto_message_on_action     = false;

    public static $rightname  = 'database_inventory';

    public static function getTypeName($nb = 0)
    {
        return _n('Static group', 'Static groups', $nb, 'databaseinventory');
    }

    public static function canCreate()
    {
        return Session::haveRight(static::$rightname, UPDATE);
    }

    public function canCreateItem()
    {
        return Session::haveRight(static::$rightname, UPDATE);
    }

    public static function canPurge()
    {
        return Session::haveRight(static::$rightname, UPDATE);
    }

    public function getTabNameForItem(CommonGLPI $item, $withtemplate = 0)
    {
        if (get_class($item) == PluginDatabaseinventoryComputerGroup::getType()) {
            $count = 0;
            $count = countElementsInTable(self::getTable(), ['plugin_databaseinventory_computergroups_id' => $item->getID()]);
            $ong = [];
            $ong[1] = self::createTabEntry(self::getTypeName(Session::getPluralNumber()), $count);
            return $ong;
        }
        return '';
    }

    public static function displayTabContentForItem(CommonGLPI $item, $tabnum = 1, $withtemplate = 0)
    {
        switch ($tabnum) {
            case 1:
                self::showForItem($item);
                break;
        }
        return true;
    }

    private static function showForItem(PluginDatabaseinventoryComputerGroup $computergroup)
    {
        global $DB;

        $ID = $computergroup->getField('id');
        if (!$computergroup->can($ID, UPDATE)) {
            return false;
        }

<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 1dee4db (add twig for computergroupsstatic)
        $staticsgroups = new PluginDatabaseinventoryComputerGroupStatic();
        $staticgrouplist = $staticsgroups->find(
            [
                'plugin_databaseinventory_computergroups_id' => $ID
            ]
        );
<<<<<<< HEAD
=======
=======

        $computers = new Computer();
        $listofcomputers = [];
        $used = [];
        foreach ($staticgrouplist as $staticgroup) {
            $used[] = $staticgroup['computers_id'];
            if ($computers->getFromDB($staticgroup['computers_id'])) {
                $listofcomputers[] = $computers->fields +
                [
                    'entityname' => Entity::getById($computers->fields['entities_id'])->fields['completename'],
                    'link' => $computers->getLinkURL(),
                    'idcompgroupstatic' => $staticgroup['id'],
                ];
            }
        }
<<<<<<< HEAD

>>>>>>> 1dee4db (add twig for computergroupsstatic)
=======
>>>>>>> b15d470 (feature(plugin) pass all html page in twig)
        TemplateRenderer::getInstance()->display(
            '@databaseinventory/computergroupstatic.html.twig',
            [
                'item' => PluginDatabaseinventoryDatabaseParam::getById($ID),
                'computerslist' => $listofcomputers,
                'groupstaticclass' => PluginDatabaseinventoryComputerGroupStatic::class,
                'canread' => $computergroup->can($ID, READ),
                'canedit' => $computergroup->can($ID, UPDATE),
                'canadd' => $computergroup->canAddItem('itemtype'),
                'used' => $used,
            ]
        );
        return true;
<<<<<<< HEAD
<<<<<<< HEAD

        $datas = [];
        $used  = [];
        $params = [
            'SELECT' => '*',
            'FROM'   => self::getTable(),
            'WHERE'  => ['plugin_databaseinventory_computergroups_id' => $ID],
        ];
>>>>>>> edcd9ee (create twig for databaseparam + set databaseparam on home page)

        $computers = new Computer();
        $listofcomputers = [];
        $used = [];
        foreach ($staticgrouplist as $staticgroup) {
            $used[] = $staticgroup['computers_id'];
            if ($computers->getFromDB($staticgroup['computers_id'])) {
                $listofcomputers[] = $computers->fields +
                [
                    'entityname' => Entity::getById($computers->fields['entities_id'])->fields['completename'],
                    'link' => $computers->getLinkURL(),
                    'idcompgroupstatic' => $staticgroup['id'],
=======
        echo "<div class='spaced'>";
        if ($canread) {
            echo "<div class='spaced'>";
            if ($canedit) {
                Html::openMassiveActionsForm('mass' . __CLASS__ . $rand);
                $massiveactionparams = ['num_displayed'
                           => min($_SESSION['glpilist_limit'], $number),
                    'specific_actions'
                           => ['purge' => _x('button', 'Remove')],
                    'container'
                           => 'mass' . __CLASS__ . $rand
>>>>>>> 1dee4db (add twig for computergroupsstatic)
                ];
            }
        }
        TemplateRenderer::getInstance()->display(
            '@databaseinventory/computergroupstatic.html.twig',
            [
                'item' => PluginDatabaseinventoryDatabaseParam::getById($ID),
                'computerslist' => $listofcomputers,
                'groupstaticclass' => PluginDatabaseinventoryComputerGroupStatic::class,
                'canread' => $computergroup->can($ID, READ),
                'canedit' => $computergroup->can($ID, UPDATE),
                'canadd' => $computergroup->canAddItem('itemtype'),
                'used' => $used,
            ]
        );
        return true;
=======
>>>>>>> b15d470 (feature(plugin) pass all html page in twig)
    }

    public static function install(Migration $migration)
    {
        global $DB;

        $default_charset = DBConnection::getDefaultCharset();
        $default_collation = DBConnection::getDefaultCollation();
        $default_key_sign = DBConnection::getDefaultPrimaryKeySignOption();

        $table = self::getTable();
        if (!$DB->tableExists($table)) {
            $migration->displayMessage("Installing $table");
            $query = <<<SQL
                CREATE TABLE IF NOT EXISTS `$table` (
                    `id` int {$default_key_sign} NOT NULL AUTO_INCREMENT,
                    `plugin_databaseinventory_computergroups_id` int {$default_key_sign} NOT NULL DEFAULT '0',
                    `computers_id` int {$default_key_sign} NOT NULL DEFAULT '0',
                    PRIMARY KEY (`id`),
                    KEY `computers_id` (`computers_id`),
                    KEY `plugin_databaseinventory_computergroups_id` (`plugin_databaseinventory_computergroups_id`)
                ) ENGINE=InnoDB DEFAULT CHARSET={$default_charset} COLLATE={$default_collation} ROW_FORMAT=DYNAMIC;
SQL;
            $DB->query($query) or die($DB->error());
        }
    }

    public static function uninstall(Migration $migration)
    {
        global $DB;
        $table = self::getTable();
        if ($DB->tableExists($table)) {
            $DB->query("DROP TABLE IF EXISTS `" . self::getTable() . "`") or die($DB->error());
        }
    }
}
