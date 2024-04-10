<h4>استعراض المتجر</h4>

<table class="table responsive-table" id="sorting-advanced">

    <thead>
    <tr>
        <th scope="col"><input type="checkbox" name="check-all" id="check-all" value="1"></th>
        <th scope="col">اسم الكتاب</th>
        <th scope="col" width="12%" class="align-center hide-on-mobile">تاريخ النشر</th>
        <th scope="col" width="8%" class="align-center hide-on-mobile-portrait">الحالة</th>
        <th scope="col" width="20%" class="hide-on-tablet">علامات</th>
        <th scope="col" width="120" class="align-center">الاجراءات</th>
    </tr>
    </thead>

    <tfoot>
    <tr>
        <td colspan="6">
            يمكنك فلترة الإظهار بالضغط على الحقل المطلوب
        </td>
    </tr>
    </tfoot>

    <tbody>

    <?php

    //if (!isset($_GET['think'])) $where = "WHERE `activated` = '1'"; else $where = "WHERE `activated` = '0'";

    $result = mysql_query("SELECT * FROM `books` ORDER BY sort_id ASC") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

    $i = 1;

    while($row = mysql_fetch_object($result)){

        if($row->book_type == 1) $book_type = 'مجاني'; else  $book_type = 'مدفوع';

        if($row->book_dir == 1) $book_dir = 'LTR'; else  $book_dir = 'RTL';

        if($row->parent == 0){
            $parent_title = 'رئيسي';
            $parent = '<a href=index.php?section=AddToStore&parent='.$row->id.' target="_blank" class="button icon-gear with-tooltip" title="اضافة كتاب فرعي"></a>';
        }
        else{
            $parent_title = 'فرعي';
            $parent = false;
        }

        $added_by = @mysql_result( mysql_query("SELECT name FROM `members` WHERE `id` = '{$row->added_by}' ") ,0 );

        print <<<EOF

        <tr id="$row->id">
            <th scope="row" class="checkbox-cell">$row->id</th>
            <td>$row->book_name</td>
            <td>$row->publish_date</td>
            <td>$book_type</td>
            <td>
            <small class="tag">$added_by</small>
            <small class="tag green-bg">$book_dir</small>
            <small class="tag silver-bg">$parent_title</small>

            <td class="align-left vertical-center">
                                <span class="button-group compact">
                                    $parent
                                    <a href="index.php?section=EditProduct&id=$row->id" class="button icon-pencil">تعديل</a>
                                    <a href="index.php?section=ShowStore&do=remove&id=$row->id" class="button icon-trash with-tooltip confirm" title="حذف"></a>
                                </span>
            </td>
        </tr>

EOF;

        $i++;
    }

    ?>
    </tbody>

</table>

<script>
    $(document).ready(function() {

        // Call template init (optional, but faster if called manually)
        //$.template.init();

        // Table sort - DataTables
        var table = $('#sorting-advanced');
        table.dataTable({
            'aoColumnDefs': [
                { 'bSortable': false, 'aTargets': [ 0, 5 ] }
            ],
            "bSort": false,
            'sPaginationType': 'full_numbers',
            'oLanguage': {
                "sLengthMenu": "استعراض _MENU_ سجل بكل صفحة",
                "sZeroRecords": "عفوا لم توجد المعلومات المطلوبة",
                "sInfo": "استعراض _START_ الى _END_ من _TOTAL_ سجلات",
                "sInfoEmpty": "Showing 0 to 0 of 0 records",
                "sInfoFiltered": "(يتم عرض السجلات من اصل _MAX_)",
                "sSearch" : "بحث سريع"
            },
            'bStateSave': false,
            'sDom': '<"dataTables_header"lfr>t<"dataTables_footer"ip>',
            'fnInitComplete': function( oSettings )
            {
                // Style length select
                table.closest('.dataTables_wrapper').find('.dataTables_length select').addClass('select blue-gradient glossy').styleSelect();
                tableStyled = true;
            }
        });


        $("#sorting-advanced tbody").sortable({

            update : function () {

                var neworder = new Array();

                $('#sorting-advanced tbody tr').each(function() {

                    //get the id
                    var id  = $(this).attr("id");
                    //create an object
                    var obj = [];
                    //insert the id into the object
                    obj = id;
                    //push the object into the array
                    neworder.push(obj);

                });

                $.post( "../index.php?task=sorting",{'neworder':neworder});

            }
        });

        <?php
        if(!empty($message) && $ok){
            echo "notify('$message', 'تنبيه', {
                        icon: 'img/demo/icon.png',
                        showCloseOnHover: false,
                        hPos: 'right',
                        groupSimilar: false
                    });";
        }
        ?>


    });

</script>