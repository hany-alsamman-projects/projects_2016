
            echo'<p id="ticket-assign">
			<label for="ticket_assign">' . __( 'تحديد الموظف: <em>يمكنك اختيار اكثر من موظف والفصل بينهم بإستعمال الفاصلة , </em>', APP_TD ) . '</label>
			<input type="text" style="direction: ltr" name="ticket_assign" value="' . ( 'update' == $context ? qc_assigned_to_flat() : '' ) . '" />
			</p>';