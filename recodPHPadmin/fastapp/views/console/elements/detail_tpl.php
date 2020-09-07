
<table class="table table-bordered table-striped table-condensed">
    <thead>

        <tr>
            <th>Field Name</th>           
            <th>Data</th> 
        </tr>
    </thead>   
    <tbody>
        <? foreach ($table_meta['data'] as $t_key => $table_td): ?>
            <tr>    
                <td class="center"><?= ucfirst(str_replace('_', ' ', $t_key)) ?></td>                    
                <?
                if (is_array($table_meta['config']['use_status_columns'])) {
                    if (in_array($t_key, $table_meta['config']['use_status_columns']) === TRUE) {
                        ?> 
                        <td class="center">                                                                                          
                            <?
                            switch (intval($table_td)) {
                                case 1 :
                                    echo '<span class="label label-success">On</span>';
                                    break;
                                default :
                                    echo '<span class="label label-important">Off</span>';
                            }
                            ?>
                        </td> <?
                continue;
            }
        }
        if (is_array($table_meta['config']['use_dropdown_columns_options'])) {
            if (array_key_exists($t_key, $table_meta['config']['use_dropdown_columns_options']) === TRUE) {
                            ?> 
                        <td class="center">    
                            <?php if(isset($table_meta['config']['use_dropdown_columns_options']['multi'][$t_key])){
                                $table_td = json_decode($table_td, TRUE);
                                foreach ($table_td as $m_key=> $m_value) {
                                   if($m_key>0){
                                        echo ',';
                                    }
                                    echo $table_meta['config']['use_dropdown_columns_options'][$t_key][$m_value];
                                    
                                }
                            } else {
                             echo isset($table_meta['config']['use_dropdown_columns_options'][$t_key][$table_td])?$table_meta['config']['use_dropdown_columns_options'][$t_key][$table_td]:'N/A';

                            }?>
                        </td> <?
                continue;
            }
        }
        if (is_array($table_meta['config']['use_file_columns'])) {
            $arr_index = array_search($t_key, $table_meta['config']['use_file_columns']);
            if ($arr_index !== FALSE) {
                ?> 
                <td class="center">
                    <?php
                    $extnsn = strtolower(end(explode('.',$table_td)));
                     if(in_array($extnsn,array('jpg','png','gif','jpeg'))===false){?>                                                                                          
                    <a target="_BLANK" href="/uploads/<?php echo NODE?>/<?= $table_meta['config']['use_file_columns_path'][$t_key]?>/<?php echo $table_td?>"><?=$table_td?></a>
                     <?php }else{ ?>
                        <a target="_BLANK" href="/uploads/<?php echo NODE?>/<?= $table_meta['config']['use_file_columns_path'][$t_key]?>/<?php echo $table_td?>"><img src='/uploads/<?php echo NODE?>/<?= $table_meta['config']['use_file_columns_path'][$t_key]?>/<?php echo $table_td?>'/></a>

                     <?php } ?>
                </td> <?php
                continue;
            }
        }

        if (is_array($table_meta['config']['use_image_columns'])) {
            $arr_index = array_search($t_key, $table_meta['config']['use_image_columns']);
            if ($arr_index !== FALSE) {
                            ?> 
                        <td class="center"> 
                            <img  style="max-width: 300px" src='<?= $table_td ? ($table_meta['config']['use_image_columns_path'][0] ? $table_meta['config']['use_image_columns_path'][0] : '' ) . $table_td : cdn_url() . 'uploads/noImage.jpg'; ?>' alt="<?= $table_td ?>"/>

                        </td> <?
            continue;
        }
    }
                    ?>
                <td class="center"><?= htmlspecialchars_decode($table_td) ?></td>


            </tr>
        <? endforeach; ?>                          
    </tbody>
</table>  
