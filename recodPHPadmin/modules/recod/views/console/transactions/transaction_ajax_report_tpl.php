<table style="width:100%;">
    <? 
    $total_amount=0;
    foreach ($data as $key => $value){ ?>
        <tr>
            <td <?=$total_amount+=$value['transaction_amount']; ?>>
                </td>
        </tr>
    <? } ?>
    <tr class="total">
    <td><h1 style="text-align: center;background-color: green;font-family: initial;color: white">Total Transaction Amount: <?= round($total_amount) ?></h1></td>
    </tr>

</table>
<table class="calculation" style="width:100%;">
    <tr class="heading">
        <td width="" style="text-align:center; font-weight:bold;"><b>Sl No.</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>User Name<br>(User Member Id)</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Transction Type</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Transction Category</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Transction Note</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Transction Amount</b></td>
        <td width="" style="text-align:center; font-weight:bold;"><b>Transction Time</b></td>
    </tr>
    <?
    //pr($return_purchase_data);
        //pr($return_purchase_data,1);user_name
        $counter=1;
        foreach ($data as $key => $value){
            ?>
            <tr>
                <td style="text-align:center;"><?= $counter++ ?></td>
                <td style="text-align:center;"><?= $value['user_name'] ?> (<?= $value['user_member_id'] ?>)</td>
                <?php if ($value['transaction_type']=='debit') { ?>
                <td style="text-align:center; color: red"><?= $value['transaction_type'] ?></td>
                <?php }else{ ?>
                <td style="text-align:center; color: green"><?= $value['transaction_type'] ?></td>
                <?php } ?>
                <td style="text-align:center;"><?= $value['transaction_category'] ?></td>
                <td style="text-align:center;"><?= $value['transaction_note'] ?></td>
                <td style="text-align:center;"><?= $value['transaction_amount'] ?></td>
                <td style="text-align:center;"><?= $value['transaction_timestamp'] ?></td>
              </tr>
    <? } ?>
    <!-- <tr style="text-align:center;">
        <td colspan="8">Total</td>
        <td ><?= round($total_mrp, 1) ?></td>
    </tr> -->
</table>
