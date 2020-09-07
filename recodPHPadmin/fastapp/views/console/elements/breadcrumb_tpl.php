<div>
    <ul class="breadcrumb">

        <?if(isset($site_breadcrumb)) :
        foreach($site_breadcrumb as $node_name=>$node_link):?>
        <li>
            <a href="<?=$node_link ?>"><?= $node_name ?></a><span class="divider">/</span>
        </li>
        <?  endforeach;
        endif;
        ?>
        <li style="float: right; margin-top: -7px;"><a class="btn btn-minimize btn-round" href="javascript:void(0);" onclick="goBack();"><span title="Go Back" class="icon icon-undo" data-rel="tooltip" style="cursor: pointer"></span></a></li>

    </ul>
</div>
<script>
    function goBack() {
        if (typeof $('ul.breadcrumb  li:nth-last-child(3)').children('a').attr('href') != 'undefined')
            window.location.href = $('ul.breadcrumb  li:nth-last-child(3)').children('a').attr('href');
        else
            window.history.back();
    }
</script>