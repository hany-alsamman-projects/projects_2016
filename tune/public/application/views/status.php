<div class="clear">
	<table id="flex1" border="0" cellpadding="0" cellspacing="0" style="display: table;">
	</table>
	<script type="text/javascript">
$(function () {
    $("#flex1").flexigrid({
        url: 'index.php?task=history&funds=<?=$_GET['funds']?>',
        dataType: 'json',
        colModel: [{
            display: 'Amount',
            name: 'amount',
            width: 100,
            sortable: true,
            align: 'left'
        }, {
            display: 'Methods',
            name: 'methods',
            width: 100,
            sortable: true,
            align: 'left'
        }, {
            display: 'Transaction No',
            name: 'trans_no',
            width: 120,
            sortable: true,
            align: 'left'
        }, {
            display: 'Purse / Account No',
            name: 'purse_account',
            width: 120,
            sortable: true,
            align: 'left'
        }, {
            display: 'Tune Trader Account No',
            name: 'tune_no',
            width: 150,
            sortable: true,
            align: 'left'
        }
        
        ],
        buttons: [{
            name: 'Edit',
            bclass: 'edit',
            onpress: doCommand
        }, {
            name: 'Delete',
            bclass: 'delete',
            onpress: doCommand
        }, {
            separator: true
        }],
        searchitems: [{
            display: 'Amount',
            name: 'amount'
        }, {
            display: 'Methods',
            name: 'methods',
            isdefault: true
        }, {
            display: 'Transaction No',
            name: 'trans_no'
        }],
        sortname: "id",
        sortorder: "asc",
        usepager: true,
        title: "Funds <?=$_GET['funds']?>",
        useRp: true,
        rp: 10,
        showTableToggleBtn: true,
        resizable: false,
        width: 650,
        height: 270,
        singleSelect: true
    });
    
    function doCommand(com, grid) {
        if (com == 'Edit') {
            $('.trSelected', grid).each(function () {
                var id = $(this).attr('id');
                id = id.substring(id.lastIndexOf('row') + 3);
                alert("Edit row " + id);
            });
        } else if (com == 'Delete') {
            $('.trSelected', grid).each(function () {
                var id = $(this).attr('id');
                id = id.substring(id.lastIndexOf('row') + 3);
                alert("Delete row " + id);
            });
        }
    }   
    
});

	</script>
</div>
