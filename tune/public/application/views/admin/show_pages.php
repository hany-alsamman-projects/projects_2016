<script language="javascript" type="text/javascript">


		$(document).ready(function()
		{
			/*
			 * lang menu fot editing pages
			 */
			
			$('.keywords li').bind('contextMenu', function(event, list)
			{
			    var li = $(this);
                
                var langID = li.attr('id');
             
				list.push({ text: 'English', link:'./?section=EditPage&id='+langID+'', icon:'us' });
				list.push({ text: 'French', link:'./?section=EditPage&id='+langID+'', icon:'fr' });
			});
            
            
			// Apply to table
			$('.sortable').each(function(i)
			{
				// DataTable config
				var table = $(this),
					oTable = table.dataTable({
						/*
						 * We set specific options for each columns here. Some columns contain raw data to enable correct sorting, so we convert it for display
						 * @url http://www.datatables.net/usage/columns
						 */
						aoColumns: [
							{ bSortable: false },	// No sorting for this columns, as it only contains checkboxes
							{ sType: 'string' },
							{ bSortable: false },
//							{ sType: 'numeric', bUseRendered: false, fnRender: function(obj) // Append unit and add icon
//								{
//									return '<small><img src="images/icons/fugue/image.png" width="16" height="16" class="picto"> '+obj.aData[obj.iDataColumn]+' Ko</small>';
//								}
//							},
                            { sType: 'date' },
							{ sType: 'string' },
							{ sType: 'numeric', bUseRendered: false, fnRender: function(obj) // Size is given as float for sorting, convert to format 000 x 000
								{
									return obj.aData[obj.iDataColumn].split('.').join(' x ');
								}
							},
                            { sType: 'string' },
							{ bSortable: false }	// No sorting for actions column
						],
						
						/*
						 * Set DOM structure for table controls
						 * @url http://www.datatables.net/examples/basic_init/dom.html
						 */
						sDom: '<"block-controls"<"controls-buttons"p>>rti<"block-footer clearfix"lf>',
						
						/*
						 * Callback to apply template setup
						 */
						fnDrawCallback: function()
						{
							this.parent().applyTemplateSetup();
						},
						fnInitComplete: function()
						{
							this.parent().applyTemplateSetup();
						}
					});
				
				// Sorting arrows behaviour
				table.find('thead .sort-up').click(function(event)
				{
					// Stop link behaviour
					event.preventDefault();
					
					// Find column index
					var column = $(this).closest('th'),
						columnIndex = column.parent().children().index(column.get(0));
					
					// Send command
					oTable.fnSort([[columnIndex, 'asc']]);
					
					// Prevent bubbling
					return false;
				});
				table.find('thead .sort-down').click(function(event)
				{
					// Stop link behaviour
					event.preventDefault();
					
					// Find column index
					var column = $(this).closest('th'),
						columnIndex = column.parent().children().index(column.get(0));
					
					// Send command
					oTable.fnSort([[columnIndex, 'desc']]);
					
					// Prevent bubbling
					return false;
				});
			});
            
            
        });
                
</script>

<section class="grid_12">
			<div class="block-border"><form class="block-content form" id="table_form" method="post" action="">
				<h1>Show <?=$_GET['think']?> Pages <a href="./?section=AddPage&active=pages"><img src="images/icons/fugue/plus-circle-blue.png" width="16" height="16"> add</a></h1>
			     
				<table class="table sortable no-margin" cellspacing="0" width="100%">
				
					<thead>
						<tr>
							<th class="black-cell"><span class="noloading"></span></th>
							<th scope="col">
								<span class="column-sort">
									<a href="#" title="Sort up" class="sort-up"></a>
									<a href="#" title="Sort down" class="sort-down"></a>
								</span>
								Page Title
							</th>
							<th scope="col">
								<span class="column-sort">
									<a href="#" title="Sort up" class="sort-up"></a>
									<a href="#" title="Sort down" class="sort-down"></a>
								</span>
								Languages
							</th>

							<th scope="col">
								<span class="column-sort">
									<a href="#" title="Sort up" class="sort-up"></a>
									<a href="#" title="Sort down" class="sort-down"></a>
								</span>
								Creation Time
							</th>
							<th scope="col">
								<span class="column-sort">
									<a href="#" title="Sort up" class="sort-up"></a>
									<a href="#" title="Sort down" class="sort-down"></a>
								</span>
								Added By
							</th>
							<th scope="col">
								<span class="column-sort">
									<a href="#" title="Sort up" class="sort-up"></a>
									<a href="#" title="Sort down" class="sort-down"></a>
								</span>
								Hits
							</th>
                            
							<th scope="col">
								<span class="column-sort">
									<a href="#" title="Sort up" class="sort-up"></a>
									<a href="#" title="Sort down" class="sort-down"></a>
								</span>
								Type
							</th>                                                  
                            
							<th scope="col" class="table-actions">Actions</th>
						</tr>
					</thead>
					
					<tbody>
                    
                    
<?php

if (isset($_GET['think'])) $where = "WHERE `approved` = '0'"; else $where = "WHERE `lang` = '0'";

$result = mysql_query("SELECT * FROM `pages` $where ORDER BY parent,title") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);    
    
    $i = 1;
    
    while($row = mysql_fetch_object($result)){


        $added_time = strtok("$row->creation_date", " ");
        $added_by = mysql_result( mysql_query("SELECT name FROM `members` WHERE `id` = '{$row->added_by}' ") , 0);
        
        
        $row->type = ($row->type == '1') ? 'Single' : 'Addtional';


                    print '<tr>
							<td class="th table-check-cell">
                            <!--
<input type="checkbox" name="selected[]" id="table-selected-'.$i.'" value="'.$i.'">
-->
                            <span class="number">'.$i.'</span>
                            </td>
							<td>'.$row->title.'</td>
							<td>
                                <!-- Note the required class: menu-opener -->
                                <div class="button menu-opener">
                                    English
                                     
                                    <!-- This is the arrow down image -->
                                    <div class="menu-arrow">
                                        <img src="images/menu-open-arrow.png" width="16" height="16">
                                    </div>
                                     
                                    <!-- Menu content -->
                                    <div class="menu">
                                        <ul>
                                            '.$this->BUILD_PAGES_LANG($row->id).'
                                        </ul>
                                    </div>
                                    <!-- End  of menu content -->
                                </div>
                            </td>
							<td>'.$added_time.'</td>
							<td>'.$added_by.'</td>
                            <td>'.$row->hits.'</td>
                            <td>'.$row->type.'</td>
							<td class="table-actions">';
                            
                             if($row->hidden == 1){
                                print '<a class="with-tip" href="index.php?section=ChangeLink&id='.$row->id.'" title="Enable"><img src="images/icons/fugue/active.png" alt="Enable"></a>';
                             }else{
                                print '<a class="with-tip" href="index.php?section=ChangeLink&id='.$row->id.'" title="Disable"><img src="images/icons/fugue/deactive.png" alt="Disable"></a>';
                             }
                                
                            print '<a class="with-tip" href="index.php?section=EditPage&id='.$row->id.'" title="edit"><img src="images/icons/fugue/pencil.png" alt="edit"></a>';
							print '<a class="with-tip" href="index.php?section=RemovePage&id='.$row->id.'&active=pages" title="Remove"><img src="images/icons/fugue/cross-circle.png" alt="delete"></a>';

					print '		</td>
						</tr>';
                                            

        $i++;
}

?>                
						
					</tbody>
				
				</table>
					
			</form></div>
		</section>