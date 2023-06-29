<h1>User List</h1>
<?php

// TODO : test if user is connected and can show this page
?>
<?php include "Views/Partials/editUserModal.ptl.php" ?>
<nav>
    <ul>
        <li><a href="/sys/user/list?action=faker">Generate</a></li>
    </ul>
</nav>
<table id="userTable" class="display">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>E-mail</th>
            <th>Register Date</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
    </thead>
</table>

<?php $this->partial("form", $createUserForm, $createUserFormErrors); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
<script>

    $(document).ready(function() {
        let table = $('#userTable').DataTable({
            'processing': true,
            'serverSide': true,
            'serverMethod': 'get',
            'ajax': {
                'url':'/api/user/list'
            },
            columnDefs: [
                {
                    target: 0,
                    visible: false,
                    searchable: false,
                }
            ],
            order: [[1, 'asc']],
            'columns': [
                { data: 'id' },
                { data: 'pseudo' },
                { data: 'first_name' },
                { data: 'last_name' },
                { data: 'email' },
                { data: 'date_inscription' },
                { data: 'role_id' },
                { data: 'action'}
            ],
            'drawCallback': function() {
                let arr_edit = document.getElementsByClassName('row-edit-button');
                for(let elt of arr_edit) {
                    elt.addEventListener('click', function(e) {
                        e.preventDefault();
                        let uriParam = e.target.href.split('?')[1];
                        let params = uriParam.split('&').map(function(i) {
                            return i.split('=');
                        }).reduce(function(memo, i) {
                            memo[i[0]] = i[1] == +i[1] ? parseFloat(i[1],10) : decodeURIComponent(i[1]);
                            return memo;
                        }, {});
                        let data = table.row($(this).parents('tr')).data();
                        let modalContainer = $('#modal-container');
                        modalContainer.addClass("active");

                        let form = $('#edit-user-form');
                        let action = form.attr('action');
                        let searchParams = new URLSearchParams(action.split('?')[1]);
                        let baseURL = action.split('?')[0];
                        searchParams.delete('id');
                        let searchParamsStr = searchParams.toString().concat("&id="+data.id);
                        action = baseURL.concat("?"+searchParamsStr);
                        form.attr('action', action);

                        $('#closeModal').on('click', function () {
                            modalContainer.removeClass("active");
                        });

                    });
                }
            }
        });
    });
</script>
