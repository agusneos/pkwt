<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-scrollview.js')?>"></script>
<script type="text/javascript" src="<?=base_url('assets/easyui/datagrid-filter.js')?>"></script>
<script type="text/javascript">
var url;

function adminMenuCreate(){
    $('#dlg-admin-menu').dialog('open').dialog('setTitle','Tambah Data');
    $('#fm-admin-menu').form('clear');
    url = '<?php echo site_url('admin/menu/create'); ?>';
}

function adminMenuUpdate(){
    var row = $('#grid-admin-menu').datagrid('getSelected');
    if(row){
        $('#dlg-admin-menu').dialog('open').dialog('setTitle','Edit Data');
        $('#fm-admin-menu').form('load',row);
        url = '<?php echo site_url('admin/menu/update'); ?>/' + row.id;
    }
}

function adminMenuSave(){
    $('#fm-admin-menu').form('submit',{
        url: url,
        onSubmit: function(){
            return $(this).form('validate');
        },
        success: function(result){
            var result = eval('('+result+')');
            if(result.success){
                $('#dlg-admin-menu').dialog('close');
                $('#grid-admin-menu').datagrid('reload');
            } else {
                $.messager.show({
                    title: 'Error',
                    msg: result.msg
                });
            }
        }
    });
}

function adminMenuHapus(){
    var row = $('#grid-admin-menu').datagrid('getSelected');
    if (row){
        $.messager.confirm('Konfirmasi','Anda yakin ingin menghapus data ID '+row.id+' ?',function(r){
            if (r){
                $.post('<?php echo site_url('admin/menu/delete'); ?>',{id:row.id},function(result){
                    if (result.success){
                        $('#grid-admin-menu').datagrid('reload');
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
    #fm-admin-menu{
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
<table id="grid-admin-menu" toolbar="#toolbar-admin-menu"
    data-options="pageSize:50, singleSelect:true, fit:true, fitColumns:true">
    <thead>
        <tr>              
            <th data-options="field:'id'" width="30" align="center" sortable="true">ID</th>            
            <th data-options="field:'parentId'" width="30" align="center" sortable="true">Parent Menu</th>
            <th data-options="field:'name'" width="100" halign="center" sortable="true">Nama Menu</th>
            <th data-options="field:'uri'" width="100" halign="center" sortable="true">URI</th>
            <th data-options="field:'allowed'" width="100" halign="center" sortable="true">Allowed</th>
            <th data-options="field:'iconCls'" width="100" halign="center" sortable="true">Icon</th>
        </tr>
    </thead>
</table>

<script type="text/javascript">
    $('#grid-admin-menu').datagrid({view:scrollview,remoteFilter:true,
        url:'<?php echo site_url('admin/menu/index'); ?>?grid=true'}).datagrid('enableFilter');
</script>
<!-- Toolbar -->
<div id="toolbar-admin-menu">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="adminMenuCreate()">Tambah Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="adminMenuUpdate()">Edit Data</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="adminMenuHapus()">Hapus Data</a>
</div>

<!-- Dialog Form -->
<div id="dlg-admin-menu" class="easyui-dialog" style="width:400px; height:300px; padding: 10px 20px" closed="true" buttons="#dlg-buttons-admin-menu">
    <form id="fm-admin-menu" method="post" novalidate>
        <div class="fitem">
            <label for="type">Parent Menu</label>
            <input class="easyui-combobox" name="parentId" data-options="
                url:'<?php echo site_url('admin/menu/getParent'); ?>',
                method:'get', valueField:'id', textField:'name', panelHeight:'auto'">
        </div>
        <div class="fitem">
            <label for="type">Nama Menu</label>
            <input type="text" name="name" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">URI</label>
            <input type="text" name="uri" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Allowed</label>
            <input type="text" name="allowed" class="easyui-validatebox" required="true"/>
        </div>
        <div class="fitem">
            <label for="type">Icon</label>
            <input type="text" name="iconCls" class="easyui-validatebox" required="true"/>
        </div>
    </form>
</div>

<!-- Dialog Button -->
<div id="dlg-buttons-admin-menu">
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-ok" onclick="adminMenuSave()">Simpan</a>
    <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg-admin-menu').dialog('close')">Batal</a>
</div>
