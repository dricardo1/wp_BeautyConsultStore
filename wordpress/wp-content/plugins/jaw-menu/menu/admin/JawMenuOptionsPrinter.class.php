<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of JawMenuOptionsPrinter
 *
 * @author jawtemplates
 */
class JawMenuOptionsPrinter {

    public $itemId;
    public $menuId;
    
    public $type;
    public $title;
    public $width;
    public $customClass;
    public $selectData;
    public $defaultValue;
    public $showLevel;
    
    private $_itemValue;

    /**
     * var $itemId - menu item id, eg. 12
     * var $menuItem - menuId, eg. menu-item-test
     * var $args - menu arguments 
     */
    public function showMenuOption($itemId, $menuId, $args) {

        $default_option = array(
            'type' => 'text',
            'title' => '',
            'width' => 'wide',
            'customClass' => '',
            'selectData' => array(),
            'defaultValue' => '',
            'showLevel' => 'zero-plus'
        );

        $args = wp_parse_args($args, $default_option);
        extract($args);

        $this->itemId = $itemId;
        $this->menuId = $menuId;
        
        $this->type = $type;
        $this->title = $title;
        $this->width = $width;
        $this->customClass = $customClass;
        $this->selectData = $selectData;
        $this->defaultValue = $defaultValue;
        $this->showLevel = $showLevel;

        $this->_itemValue = $this->_getItemOption($itemId, $menuId);

        switch ($this->type) {
            case 'text':
                $this->_printText();
                break;
            case 'select':
                $this->_printSelect();
                break;
            case 'checkbox':
                $this->_printCheckBox();
                break;
            case 'textarea':
                $this->_printTextArea();
                break;
            default:
                $this->_printDefaultValueError();
        }
    }

    private function _printText() {
        ?>
        <p class="field-<?php echo $this->menuId; ?> <?php echo $this->menuId; ?> description-<?php echo $this->width; ?> description jaw-menu-custom-item <?php echo $this->showLevel; ?> <?php echo $this->customClass; ?>">
            <label for = "edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId; ?>">
                <?php echo $this->title; ?><br />
                <input type="text" id="edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId ?>" class="widefat code edit-menu-item-<?php echo $this->menuId ?>" name="menu-item-<?php echo $this->menuId; ?>[<?php echo $this->itemId; ?>]" value="<?php echo $this->_itemValue; ?>" />
            </label>
        </p>
        <?php
    }

    private function _printSelect() {
        $selected = '';
        if ($this->width == 'wide') {
            $class = 'widefat';
        }
        ?>
        <p class="field-<?php echo $this->menuId; ?> <?php echo $this->menuId; ?> description-wide description jaw-menu-custom-item <?php echo $this->showLevel; ?> <?php echo $this->customClass; ?>">
            <label for="edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId; ?>">
                <?php echo $this->title; ?><br />
                <select class="<?php echo $class; ?> edit-menu-item-<?php echo $this->menuId; ?>" name="menu-item-<?php echo $this->menuId; ?>[<?php echo $this->itemId; ?>]" id="edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId; ?>">
                    <?php if (isset($this->selectData) && !empty($this->selectData)) { ?>
                        <?php foreach ($this->selectData as $key => $value) { ?>
                            <?php $selected = ''; ?>
                            <?php if (isset($this->_itemValue) && $this->_itemValue == $key) { ?>
                                <?php $selected = 'selected="selected"'; ?>
                            <?php } ?>                            
                            <option <?php echo $selected; ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php } ?>
                    <?php } ?> 
                </select>
            </label>
        </p>
        <?php
    }

    private function _printCheckBox() {
        ?>
        <p class="field-<?php echo $this->menuId; ?> description-wide description jaw-menu-custom-item <?php echo $this->showLevel; ?> <?php echo $this->customClass; ?>">
            <label for="edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId; ?>">
                <?php if (isset($this->_itemValue) && $this->_itemValue == 'on') { ?>
                <input checked="checked" type="checkbox" name="menu-item-<?php echo $this->menuId; ?>[<?php echo $this->itemId; ?>]" value="on" id="edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId ?>">
                <?php } else { ?>
                <input type="checkbox" name="menu-item-<?php echo $this->menuId; ?>[<?php echo $this->itemId; ?>]" value="on" id="edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId ?>">
                <?php } ?>
                <?php echo $this->title; ?>
            </label>
        </p>
        <?php
    }

    private function _printTextArea() {
        ?>
        <p class="field-<?php echo $this->menuId; ?> <?php echo $this->menuId; ?> description-wide description jaw-menu-custom-item <?php echo $this->showLevel; ?> <?php echo $this->customClass; ?>">
            <label for="edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId; ?>">
                <?php echo $this->title; ?><br />
                <textarea id="edit-menu-item-<?php echo $this->menuId; ?>-<?php echo $this->itemId ?>" class="widefat edit-menu-item-<?php echo $this->menuId ?>" rows="3" cols="20" name="menu-item-<?php echo $this->menuId; ?>[<?php echo $this->itemId; ?>]"><?php echo esc_html($this->_itemValue); // textarea_escaped                ?></textarea>
                <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.', "jawtemplates"); ?></span>
            </label>
        </p>
        <?php
    }

    private function _printDefaultValueError() {
        echo '<p class = "description description-wide">';
        echo '<label>';
        echo 'This field type is not supported!';
        echo '</label>';
        echo '</p>';
    }

    private function _getItemOption($itemId, $menuId) {
        $optionId = 'menu-item-' . $menuId;
        $option = get_post_meta($itemId, JAWMENU_ITEM_OPTIONS, true);

        if (isset($option[$optionId])) {
            return $option[$optionId];
        } else {
            return '';
        }
    }

}
