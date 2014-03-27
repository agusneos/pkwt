<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-scrollview.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-filter.js')?>"></script>
<script type="text/javascript">
var url;

function adminUserCreate(){
    $('#dlg-admin-user').dialog('open').dialog('setTitle','Tambah Data');
    $('#fm-admin-user').form('clear');
    url = '<?php echo site_url('admin/user/create'); ?>';
}

function adminUserSave(){
    $('#fm-admin-user').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if(result.success){
                $('#dlg-admin-user').dialog('close');
                $('#grid-admin-user').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}

function adminUserUpdate(){
    var row = $('#grid-admin-user').datagrid('getSelected');
    if(row){
        $('#dlg-update-admin-user').dialog('open').dialog('setTitle','Edit Data');
        $('#fm-update-admin-user').form('load',row);
        url = '<?php echo site_url('admin/user/update'); ?>/' + row.user_id;
    }
}

function adminUserUpdateSave(){
    $('#fm-update-admin-user').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if(result.success){
                $('#dlg-update-admin-user').dialog('close');
                $('#grid-admin-user').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}

function adminUserReset(){
    var row = $('#grid-admin-user').datagrid('getSelected');
    if(row){
        $('#dlg-reset-admin-user').dialog('open').dialog('setTitle','Reset Password');
        $('#fm-reset-admin-user').form('load',row);
        url = '<?php echo site_url('admin/user/reset'); ?>/' + row.user_id;
    }
}

function adminUserResetSave(){
    $('#fm-reset-admin-user').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if(result.success){
                $('#dlg-reset-admin-user').dialog('close');
                $('#grid-admin-user').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}

function adminUserHapus(){
    var row = $('#grid-admin-user').datagrid('getSelected');
    if (row){
        $.messager.confirm('Konfirmasi','Anda yakin ingin menghapus data ID '+row.user_id+' ?',function(r){
            if (r){
                $.post('<?php echo site_url('admin/user/delete'); ?>',{user_id:row.user_id},function(result){
                    if (result.success){
                        $('#grid-admin-user').datagrid('reload');
                    } else {
                        $.messager.show({
                            title: 'Error',
                            msg: result.msg
                        });
                    }
                },'json');
            }
        });
    }
}


</script>
<style type="text/css">
    #fm-admin-user{
        margin:0;
        padding:10px 30px;
    }
    #fm-update-admin-user{
        margin:0;
        padding:10px 30px;
    }
    #fm-reset-admin-user{
        margin:0;
        padding:10px 30px;
    }
    .ftitle{
        font-size:14px;
        font-weight:bold;
        padding:5px 0;
        margin-bottom:10px;
        border-bottom:1px solid #ccc;
    }
    .fitem{
        margin-bottom:5px;
    }
    .fitem label{
        display:inline-block;
        width:80px;
    }
</style>

<!-- Data Grid -->
<table id="grid-admin-user" toolbar="#toolbar-admin-user"
    data-options="pageSize:50, singleSelect:true, fit:true, fitColumns:true">
    <thead>
        <tr>              
            <th data-options="field:'user_id'" width="30" align="center" sortable="true">ID</th>
            <th data-options="field:'user_nama'" width="100" halign="center" sortable="true">Nama Lengkap</th>
            <th data-options="field:'user_username'" width="50" align="center" sortable="true">Username</th>
            <th data-options="field:'user_password'" formatter="adminUserPassword" width="50" align="center" sortable="true">Password</th>
            <th data-options="field:'user_level'" width="50" align="center" sortable="true">Level</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
    $('#grid-admin-user').datagrid({view:scrollview,remoteFilter:true,
        url:'<?php echo site_url('admin/user/index'); ?>?grid=true'}).datagrid('enableFilter');
    
    function adminUserPassword(value,row,index) {
        return '**********';
    }
</script>
<!-- Toolbar -->
<div id="toolbar-admin-user">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="adminUserCreate()">Tambah Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="adminUserUpdate()">Edit Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="adminUserHapus()">Hapus Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-redo" plain="true" onclick="adminUserReset()">Reset Password</a>
</div>

<!-- Dialog Input Form -->
<div id="dlg-admin-user" class="easyui-dialog" style="width:400px; height:250px; padding: 10px 20px" closed="true" buttons="#dlg-buttons-admin-user">
    <form id="fm-admin-user" method="post" novalidate>        
        <div class="fitem">
            <label for="type">Nama Lengkap</label>
            <input type="text" name="user_nama" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Username</label>
            <input type="text" name="user_username" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Password</label>
            <input id="pass" type="password" name="user_password" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Level</label>
            <input type="text" name="user_level" class="easyui-validatebox" required="true"/>
        </div>
    </form>
</div>
<!-- Dialog Update Form -->
<div id="dlg-update-admin-user" class="easyui-dialog" style="width:400px; height:250px; padding: 10px 20px" closed="true" buttons="#dlg-buttons-update-admin-user">
    <form id="fm-update-admin-user" method="post" novalidate>        
        <div class="fitem">
            <label for="type">Nama Lengkap</label>
            <input type="text" name="user_nama" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Username</label>
            <input type="text" name="user_username" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Level</label>
            <input type="text" name="user_level" class="easyui-validatebox" required="true"/>
        </div>
    </form>
</div>
<!-- Dialog Reset Form -->
<div id="dlg-reset-admin-user" class="easyui-dialog" style="width:400px; height:250px; padding: 10px 20px" closed="true" buttons="#dlg-buttons-reset-admin-user">
    <form id="fm-reset-admin-user" method="post" novalidate>       
        <div class="fitem">
            <label for="type">Password</label>
            <input id="pass" type="password" name="user_password" class="easyui-validatebox" required="true"/>
        </div>        
    </form>
</div>

<!-- Dialog Input Button -->
<div id="dlg-buttons-admin-user">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="adminUserSave()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-admin-user').dialog('close')">Batal</a>
</div>
<!-- Dialog Update Button -->
<div id="dlg-buttons-update-admin-user">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="adminUserUpdateSave()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-update-admin-user').dialog('close')">Batal</a>
</div>
<!-- Dialog Reset Button -->
<div id="dlg-buttons-reset-admin-user">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="adminUserResetSave()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-reset-admin-user').dialog('close')">Batal</a>
</div>
