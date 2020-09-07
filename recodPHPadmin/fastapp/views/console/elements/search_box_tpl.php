<style>
.search-table-form #inputIcon,.search-table-form .datepicker {
    width: 150px;
}
</style>
<? if (isset($searchFields)): ?>
    <div class="row-fluid sortable search_box">	
        <div class="box span12">
            <div class="box-header well" data-original-title>
                <h2><i class="icon-search"></i>Search</h2>
                <div class="box-icon">
                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                </div>
            </div>
            <div class="box-content">
                <form class="search-table-form" style="display:table;margin-bottom: 0px" method="post" onsubmit="return false;">

                    <? foreach ($searchFields as $searchField): ?>
                        <div style="float: left;margin: 11px;min-width:200px;height:61px">
                            <div class="control-group">
                                <label class="control-label" for="inputIcon"><?= ucwords(str_replace('_', ' ', str_replace(array_keys(isset($this->page_config['replace_text'])?$this->page_config['replace_text']:array()), array_values(isset($this->page_config['replace_text'])?$this->page_config['replace_text']:array()), $searchField))) ?></label>
                                <div class="controls">
                                    <div class="input-prepend">
                                        <?
                                        if (is_array($table_meta['config']['use_status_columns'])) {
                                            $arr_index = array_search($searchField, $table_meta['config']['use_status_columns']);
                                            if ($arr_index !== FALSE) {
                                                ?>
                                                <input name="<?= $searchField ?>" data-no-uniform="true"  type="checkbox" class="iphone-toggle" value="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>                                          <?
                                       continue;
                                   }
                               }
                                        ?>
                        <?
                        if (is_array($table_meta['config']['use_dropdown_columns'])) {
                            $arr_index = array_search($searchField, $table_meta['config']['use_dropdown_columns']);
                            if ($arr_index !== FALSE) {
                                $choosenValue = isset($default_search_value[$searchField])?$default_search_value[$searchField]:null;
                                ?>
                                <select  name="<?= $searchField ?>" data-placeholder="type here" data-rel="chosen">
                                    <option value="">--choose one--</option>

                                    <?
                                    $optionList = (isset($table_meta['config']['use_dropdown_columns_options'][$searchField]) ? $table_meta['config']['use_dropdown_columns_options'][$searchField] : $table_meta['config']['use_dropdown_columns_options']);
                                    foreach ($optionList as $optkey => $optvalue):
                                        ?>
                                        <option <?if($optkey === $choosenValue){echo 'selected="selected"';}?> value="<?= $optkey ?>" ><?= $optvalue ?></option>
                                    <? endforeach; ?>
                                </select>               </div>
                    </div>
                </div>
                </div>                                          <?
                    continue;
                }
            }
                            ?>
        <?
        if (is_array($table_meta['config']['datepicker_columns'])) {
            $arr_index = array_search($searchField, $table_meta['config']['datepicker_columns']);
            if ($arr_index !== FALSE) {
                ?>
                <span class="add-on"><i class="icon-calendar"></i></span>
                <input type="text" class="datepicker"  name="<?= $searchField ?>" >
                </div>
                </div>
                </div>
                </div>
                <?
                continue;
            }
        }
        ?>
        <span class="add-on"><i class="icon-pencil"></i></span>
        <input  id="inputIcon" type="text" name="<?= $searchField ?>">

        </div>
        </div>
        </div>
        </div>
    <? endforeach; ?>   
    </form>
    </div>
    </div>
    </div>
<? endif; ?>